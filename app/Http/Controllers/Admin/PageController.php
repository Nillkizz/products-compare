<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Pages\PageFormRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends AbstractAdminPageController
{
  public function index(Request $request)
  {
    meta()->set('title', 'Store Pages');

    $data = [
      'pages' => Page::search(request('s'))->paginate(16),
      'allPagesCount' => Page::count()
    ];

    return view('admin.pages.pages.index', $data);
  }

  public function create(Request $request)
  {
    meta()->set('title', 'Add page');

    return view('admin.pages.pages.create');
  }

  public function store(PageFormRequest $request)
  {
    $page = Page::create($request->validated());

    return redirect()->route('admin.pages.edit', compact('page'))->with(['notify' => [
      'status' => 'success',
      'icon' => '',
      'text' => 'Page created!'
    ]]);
  }

  public function edit(Request $request, Page $page)
  {
    meta()->set('title', 'Edit page "' . $page->name . '"');
    $data = ['item' => $page];

    return view('admin.pages.pages.edit', $data);
  }

  public function update(PageFormRequest $request, Page $page)
  {
    $page->update($request->validated());

    return redirect()->route('admin.pages.edit', compact('page'))->with(['notify' => [
      'status' => 'success',
      'icon' => '',
      'text' => 'Changes saved!'
    ]]);
  }

  public function destroy(Request $request, Page $page)
  {
    return $page->delete();
  }
}
