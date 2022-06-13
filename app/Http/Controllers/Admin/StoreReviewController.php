<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreReview;
use Illuminate\Http\Request;

class StoreReviewController extends Controller
{
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\StoreReview  $storeReview
   * @return \Illuminate\Http\Response
   */
  public function destroy(StoreReview $storeReview)
  {
    return $storeReview->delete();
  }

  public function action(StoreReview $storeReview)
  {
    switch (request()->body['action']) {
      case 'moderate':
        $storeReview->setStatus('moderation');
        break;
      case 'publish':
        $storeReview->setStatus('published');
        break;
    }
    return $storeReview;
  }
}
