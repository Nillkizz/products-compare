<?php

namespace App\Http\Controllers\Public;

use App\Models\SiteOption;
use App\Services\PageService;
use Illuminate\Http\Request;

class HomeController extends AbstractPublicPageController
{
  public function show()
  {
    $data = [
      'featuredQueries' => SiteOption::get('featured_queries', true)->value,
    ];

    $page = new PageService('', false);

    if ($page->exists()) {
      $view = $page->getView();
      $page->setMeta();
      $data['page'] = $page->instance;
    } else {
      $view = 'public.pages.home';
      meta()->set('title', 'Home');
    }


    return view($view, $data);
  }
}
