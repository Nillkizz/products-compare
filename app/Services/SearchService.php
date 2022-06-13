<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Search;
use App\Models\SiteOption;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchService
{
  function __construct($search_string)
  {
    $this->search_string = $search_string;
    $this->hasSearch = !empty($this->search_string);
    $this->show_erotic_items = session('show_erotic_items', false);
    $this->isFirstQueryForSession = self::searchFirstForSession($this->search_string);

    $this->all_products = $this->getAllProducts();
    $this->hasProducts = $this->hasProducts();

    if ($this->hasProducts) {
      $this->products_without_erotic = $this->getProductsWithoutErotic($this->all_products);
      $this->has_erotic_products = $this->hasEroticProducts($this->all_products, $this->products_without_erotic);
    }

    if ($this->hasSearch && $this->isFirstQueryForSession) {
      session()->push('search_history', $this->search_string);
      Search::incrementByQS($this->search_string);
    }
    $this->data = $this->getData();
    $this->setMeta();
  }

  public function getData()
  {
    $data = [
      'hasSearch' => $this->hasSearch,
      'hasProducts' => $this->hasProducts,
      'show_erotic_items' => $this->show_erotic_items,
      'has_erotic_items' => $this->has_erotic_products ?? false,
    ];
    if ($this->hasProducts) {
      $products = $this->has_erotic_products && !$this->show_erotic_products
        ? $this->products_without_erotic
        : $this->all_products;

      $data['products'] = $this->getQueriedProducts($products);
    } else {
      $queries = Search::get_popular_queries(6);
      if (empty($queries)) $queries = SiteOption::get('featured_queries', true)->value;
      $data['popular_queries'] = $queries;
    }

    return $data;
  }

  public function hasProducts()
  {
    return $this->all_products != null ? $this->all_products->exists() : false;
  }
  public function showEroticItems()
  {
    return session('show_erotic_items', false);
  }
  public function getAllProducts()
  {
    return $this->hasSearch ? Product::search($this->search_string) : null;
  }
  public function getProductsWithoutErotic($products)
  {
    if ($products == null) return null;
    return $products->where('adult', false);
  }
  static function hasEroticProducts($products, $products_without_erotic)
  {
    return $products->count() > $products_without_erotic->count();
  }

  public function getQueriedProducts($products)
  {
    return QueryBuilder::for($products)
      ->defaultSort('name')
      ->allowedSorts('price', 'name')
      ->allowedFilters([
        AllowedFilter::scope('price_limit')
      ])->paginate(16);
  }

  public function setMeta()
  {
    meta()->set('title', $this->getTitle());
    meta()->set('description', $this->getDescription());
  }

  public function getTitle()
  {
    return $this->hasSearch ? "Search \"$this->search_string\"" : 'Catalog';
  }

  public function getDescription()
  {
    if (!$this->hasSearch) return "Catalog of popular queries";

    $search_string = $this->search_string;

    if ($this->hasProducts) {
      $lowestPrice = $this->all_products->min('price');
      $countOfProducts = $this->all_products->count();
    } else if ($this->hasSearch) $lowestPrice = $countOfProducts = 0;

    return "$search_string price from $lowestPrice $, $countOfProducts products found with the name: $search_string";
  }

  static function searchFirstForSession(string|null $search)
  {
    if ($search == null) return false;
    return !in_array($search, session('search_history', []));
  }
}
