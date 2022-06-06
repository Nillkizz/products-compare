<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class XmlProducts
{
  function __construct(string $source)
  {
    $xmlString = file_get_contents($source);
    $this->products = Arr::get(Xml2Array($xmlString), 'item', []);
  }

  /** Imports products for provided merchant */
  public function importFor($merchant)
  {
    $validated = $this->validate();

    $media = $merchant->products->map(fn ($p) => $p->media);
    $media_ids = Arr::flatten($media->pluck('*.id'));

    DB::transaction(function () use ($merchant, $validated) {
      $merchant->products()->delete();
      $merchant->products()->createMany($validated);
    }, 2);
    Media::destroy($media_ids);

    $products = $merchant->fresh()->products;
    $products->each(fn ($product) => $product->addMediaFromUrl($product->image_url)->toMediaCollection('preview'));

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
      $product['image_url'] = $product['image'];
      unset($product['image']);
    });


    $validator = Validator::make($products, [
      '*.name' => 'required|string|max:200',
      '*.link' => 'required|url|max:500',
      '*.price' => 'required|numeric',
      '*.category_full' => 'string|max:500',
      '*.category_link' => 'url|max:500',
      '*.image_url' => 'url|max:500',
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
}
