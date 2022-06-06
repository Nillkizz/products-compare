@props(['foundCount'])


<form action="{{ route('search') }}" class="mb-3" id="filters">
  @php
    $filterBtnCls = 'btn btn-outline-info ';
  @endphp
  <div class="d-flex gap-2">

    <div class="dropdown">
      <button type="button" @class($filterBtnCls . 'dropdown-toggle"') id="dropdown-price-limit" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Price limit {{ request('filter.price_limit') }}
      </button>
      <div class="dropdown-menu shadow" aria-labelledby="dropdown-price-limit">
        <div class="input-group">
          <input type="number" class="form-control" placeholder="Price limit" aria-describedby="btnGroupAddon"
            name="filter[price_limit]" value="{{ request('filter.price_limit') }}">
          <button class="btn btn-info" type="submit"><i class="fa fa-check"></i></button>
        </div>
      </div>
    </div>
    <div class="dropdown">
      @php
        $sortBy = '';
        if (str_contains(request('sort'), 'price')) {
            $sortBy = request('sort') == 'price' ? 'price asc' : 'price desc';
        }
      @endphp
      <button type="button" @class($filterBtnCls . 'dropdown-toggle"') id="dropdown-price-limit" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Sort by {{ $sortBy }}
      </button>
      <div class="dropdown-menu shadow" aria-labelledby="dropdown-price-limit">
        <button class="btn btn-info w-100" data-sort="{{ request('sort') != 'price' ? 'price' : '-price' }}">Price
          @switch(request('sort'))
            @case('price')
              <i class="fa fa-chevron-up"></i>
            @break

            @case('-price')
              <i class="fa fa-chevron-down"></i>
            @break
          @endswitch
        </button>
      </div>
    </div>
    <button type="button" @class($filterBtnCls) data-action="reset">Reset</button>
    @isset($foundCount)
      <div class="text-muted ms-3 my-auto">
        Found {{ $foundCount }} items.
      </div>
    @endisset

    <input type="text" name="s" value="{{ request('s') }}" hidden>
    <input name="sort" value="{{ request('sort') }}" hidden>
  </div>
</form>
