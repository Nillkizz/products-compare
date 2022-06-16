<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPreview;
use App\Models\Store;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class XmlProducts
{
  function __construct(string $source, $isXmlString = false)
  {
    $xmlString = $isXmlString ? $source : file_get_contents($source);

    $this->products = self::prepareProducts(Arr::get(Xml2Array($xmlString), 'item', []));
  }

  /** Imports products for provided store */
  public function importFor(Store $store)
  {
    $validated = $this->validate();
    $store->setStatus(Store::getStatusBySlug('updating')['value']);

    $store->products()->delete();
    $store->products()->createMany($validated);

    $products = $store->fresh()->products;
    $products_count = count($products);


    // Игнорируем отмену загрузки страницы пользователем
    ignore_user_abort();

    // Говорим что время на выполнение скрипта не ограничено
    set_time_limit(0);

    // Говорим что соединение надо закрыть
    header('Connection: close');

    // Перенаправляем если нужно
    //header('Location: http://site.com');

    // Отчищаем все буферы вывода 
    @ob_end_flush();
    @ob_flush();
    @flush();

    // Заканчиваем сессию пользователя (именно сессия и не давала 
    // запускать выполнение ещё одного скрипта для этого пользователя 
    // т.к. запуск скриптов лочится на файл сессий)
    if (session_id()) session_write_close();

    // Тут выполняем свой очень долгий скрипт


    $products->each(function (Product $product, $i) use ($store, $products_count) {
      $store->setUpdateProgress("$i/$products_count");
      $preview_url = $product->image_url;
      if (empty($preview_url)) return;

      $preview = ProductPreview::where(['url' => $preview_url]);
      if (!$preview->exists()) {
        $preview = ProductPreview::create(['url' => $preview_url]);
        try {
          $preview->addMediaFromUrl($preview_url)->toMediaCollection('preview');
        } catch (UnreachableUrl $e) {
          $preview->delete();
          return;
        }
      } else $preview = $preview->first();


      $product->preview()->associate($preview);
      $product->save();
    });

    $store->resetUpdateStatus();
    return $products;
  }

  public function validate()
  {
    return $this->validated = $this->validator($this->products)->validate();
  }

  /** Make validator with products array as data. */
  static function validator(array $products)
  {
    array_walk($products, function (&$product) {
      if (!Arr::has($product, 'image')) return;
      $product['image_url'] = $product['image'];
      Arr::forget($product, 'image');
    });


    $validator = Validator::make($products, [
      '*.name' => 'required|string|max:200',
      '*.link' => 'required|url|max:500',
      '*.price' => 'required|numeric',
      '*.category_full' => 'string|max:500',
      '*.category_link' => 'url|max:500',
      '*.image_url' => 'nullable|url|max:500',
      '*.in_stock' => 'numeric',
      '*.brand' => 'string|max:64',
      '*.model' => 'string|max:64',
      '*.color' => 'string|max:64',
      '*.mpn' => 'string|max:256',
      '*.gtin' => 'string|max:64',
      '*.used' => 'boolean',
      '*.adult' => 'boolean',
      '*.over_the_counter_medicine' => 'boolean'
    ]);
    return $validator;
  }

  static function prepareProducts(array $products)
  {
    $products =  array_map(function ($product) {
      $product = array_filter($product, fn ($val) => $val != []);

      array_walk($product, function (&$v, $k) {
        switch ($k) {
          case "used":
          case "adult":
          case "over_the_counter_medicine":
            $v = filter_var($v, FILTER_VALIDATE_BOOLEAN);
            break;

          case 'price':
            $v = filter_var($v, FILTER_VALIDATE_FLOAT);
            break;

          case 'in_stock':
            $v = filter_var($v, FILTER_VALIDATE_INT);
            break;
        }
      });

      return $product;
    }, $products);

    return $products;
  }
}
