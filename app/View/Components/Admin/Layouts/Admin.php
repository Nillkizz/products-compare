<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;

class Admin extends Component
{
  /**
   * Get the view / contents that represents the component.
   *
   * @return \Illuminate\View\View
   */
  public function render()
  {
    return view('admin.layouts.admin');
  }
}
