<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Services\XmlProducts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $storage = Storage::disk('assets');
    $products_xmls = $storage->files('products');


    foreach (Store::all() as $idx => $store) {
      if (count($products_xmls) <= $idx) continue;

      $file = $products_xmls[$idx];
      echo $file;

      $xmlProducts = new XmlProducts($storage->get($file), true);
      $xmlProducts->importFor($store);

      echo " Done!\n";
    };
  }
}
