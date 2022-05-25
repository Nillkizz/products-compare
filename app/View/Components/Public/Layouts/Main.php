<?php

namespace App\View\Components\Public\Layouts;

use Illuminate\View\Component;

class Main extends Component
{
  /**
   * Get the view / contents that represents the component.
   *
   * @return \Illuminate\View\View
   */
  public function render()
  {
    return view('public.layouts.main');
  }
}
