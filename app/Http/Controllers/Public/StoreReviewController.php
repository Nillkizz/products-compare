<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreReviewRequest;
use App\Models\Store;
use App\Models\StoreReview;
use Illuminate\Http\Request;

class StoreReviewController extends AbstractPublicPageController
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, Store $store)
  {
    $data = [
      'store' => $store,
      'questions' => StoreReview::QUESTIONS,
    ];
    if (in_array($store->id, session('reviewed-stores', []))) return redirect(route('store', compact('store')));

    return view('public.pages.store-review_create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreStoreReviewRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreStoreReviewRequest $request, Store $store)
  {
    $validated = $request->validated();
    $review = $store->reviews()->create($validated);

    session()->push('reviewed-stores', $store->id);

    return redirect(route('store', compact('store')));
  }
}
