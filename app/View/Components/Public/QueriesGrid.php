<?php

namespace App\View\Components\Public;

use App\Models\Product;
use App\Models\Search;
use Illuminate\View\Component;

class QueriesGrid extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($queries)
  {
    $this->queries = array_map(fn ($s) => ['value' => $s, 'preview' => Search::getPreviewByQs($s)], $queries);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    $data = [
      'queries' => $this->queries
    ];
    return view('components.public.queries-grid', $data);
  }
}
