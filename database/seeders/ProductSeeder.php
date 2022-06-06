<?php

namespace Database\Seeders;

use App\Models\Merchant;
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


    foreach (Merchant::all() as $idx => $merchant) {
      if (count($products_xmls) <= $idx) continue;

      $file = $products_xmls[$idx];
      echo $file;

      $xmlProducts = new XmlProducts($storage->get($file), true);
      $xmlProducts->importFor($merchant);

      echo " Done!\n";
    };
  }
}
