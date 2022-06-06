<x-public.layouts.main body_class="search" main_class="bg-body-light">
  <div>
    <div class="content content-full">
      <div class="push mb-5">
        @if ($hasSearch)
          <h1 class="text-center">Search "{{ request('s') }}"</h1>
        @else
          <h1 class="text-center">Catalog</h1>
        @endif
      </div>
      @if ($hasProducts)
        <x-public.products-filters :foundCount="$products->total()" />
        @if (!$show_erotic_items && $has_erotic_items)
          <div class="alert alert-warning mb-4 py-2" role="alert">
            <form method="POST">
              @csrf
              <input type="hidden" name="show_erotic_items" value="1">
              <p class="mb-0">Are you already 18 years old? <button
                  class="btn btn-outline-warning ms-3 py-0 px-2" type="submit">Yes</button></p>
            </form>
          </div>
        @endif
        <x-public.products-grid :products="$products" />
      @else
        @if ($hasSearch)
          <div class="fs-4 mb-5">
            <p class="mb-2">Products not found. Recommendations:</p>
            <ul class="fs-5">
              <li>Use fewer words</li>
              <li>Use similar words</li>
              <li>Check the spelling of words</li>
              <li>Use other similar words</li>
            </ul>
            {{-- <p>Additional suggestions in the Information section</p> --}}
          </div>
        @elseif(count($popular_queries) > 0)
          <h2 class="mb-3">Popular queries:</h2>
          <x-public.queries-grid :queries="$popular_queries" />
        @else
          <h2>Nothing found</h2>
        @endif
      @endif
    </div>
  </div>

</x-public.layouts.main>
