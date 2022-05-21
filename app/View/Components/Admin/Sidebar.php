<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Sidebar extends Component
{
  public $items = [
    'admin.dashboard' => [
      'title' => 'Dashboard',
      'icon' => 'fa fa-window-maximize',
    ],
    [
      'title' => 'Merchants',
      'icon' => 'fa fa-store',
    ],
  ];

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $walker = new \Helpers\NavBarWalker($this->items);
    $this->items = $walker->prepare($this->items);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.admin.sidebar');
  }
}
