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

    $products->each(function (Product $product, $i) use ($store, $products_count) {
      $store->setUpdateProgress("$i/$products_count");
      $preview_url = $product->image_url;
      if (empty($preview_url)) return;

      $preview = $product->preview()->where(['url' => $preview_url]);
      if (!$preview->exists()) {
        $preview = ProductPreview::create(['url' => $preview_url]);
        try {
          $preview->addMediaFromUrl($preview_url)->toMediaCollection('preview');
        } catch (UnreachableUrl $e) {
          $preview->delete();
          return;
        }
      }

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
    return array_map(function ($product) {
      // if (Arr::has($product, $field = 'image')) $product[$field] = is_string($product[$field]) ? $product[$field] : null;

      $product = array_filter($product, fn ($val) => !empty($val));



      return $product;
    }, $products);
  }
}
