<?php

namespace App\View\Components\Public;

use Illuminate\View\Component;

class Nav extends Component
{
  public $items = [
    // 'home' => [
    //   'title' => 'Home',
    //   'icon' => 'fa fa-window-maximize',
    // ],

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
    return view('components.nav');
  }
}
