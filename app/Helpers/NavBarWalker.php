<?php

namespace Helpers;

use Illuminate\Support\Arr;

/*  Recursive nav generator  */

// NavItem may be just a string, submenu or link. As $route => $navItem, or $strin if it is heading.

// Example of fullitem:
/*
    [
        'title' => 'Login',
        'type' => 'submenu',
        'icon' => 'fa fa-key',
        'submenu' => [
            'admin.dashboard' => [
                'title' => 'Dashboard',
                'icon' => 'fa fa-location-arrow',
            ],
        ],
    ],
*/

if (!class_exists('Helpers\NavBarWalker')) {
  class NavBarWalker
  {
    function __construct()
    {
      $this->hasActive = false;
      $this->level = 0;
    }
    function prepare($navItems)
    {
      $this->level++;
      $hasActive = false;
      foreach ($navItems as $route => &$navItem) {
        switch ($this->getNavItemType($navItem)) {
          case 'link':
            $navItem['type'] = 'link';
            if (!$hasActive && !$this->hasActive && request()->routeIs($route)) {
              $this->hasActive = $hasActive = $navItem['active'] = true;
            } else {
              $navItem['active'] = false;
            }
            break;
          case 'submenu':
            $navItem['type'] = 'submenu';
            $preparedNavItems = $this->prepare($navItem['submenu']);
            $navItem['submenu'] = $preparedNavItems['navItems'];
            $hasActive = $navItem['open'] = $preparedNavItems['hasActive'];
            break;
          case 'heading':
            $navItem = ['type' => 'heading', 'title' => $navItem];
          default:
            $navItem['norender'] = true;
            break;
        }
      }
      $this->level--;
      if ($this->level > 0) {
        return compact('hasActive', 'navItems');
      } else {
        return $navItems;
      }
    }
    function getNavItemType($navItem)
    {
      return is_string($navItem) ? 'heading' : Arr::get($navItem, 'type', 'link');
    }
  }
}
