<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Nav extends Component
{
  public $items = [
    'admin.dashboard' => [
      'title' => 'Dashboard',
      'icon' => 'fa fa-window-maximize',
    ],

    [
      'title' => 'Store',
      'icon' => 'fa fa-store',
      'submenu' => [
        'admin.stores.index' => [
          'title' => 'Stores',
        ],
        'admin.products' => [
          'title' => 'Products',
        ],
      ]
    ],
    'admin.pages.index' => [
      'title' => 'Pages',
      'icon' => 'fa fa-file-lines'
    ],
    [
      'title' => 'Settings',
      'icon' => 'fa fa-screwdriver-wrench',
      'submenu' => [
        'admin.settings.options.index' => [
          'title' => 'Site options',
        ],
      ]
    ]
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
