<x-public.layouts.main>
  <div class="bg-body-extra-light">
    <div class="content content-full">
      <div class="push mb-5">
        @empty(request('s'))
          <h1 class="text-center">Catalog</h1>
        @else
          <h1 class="text-center">Search "{{ request('s') }}"</h1>
        @endempty
        {{-- <h3 class="text-muted mb-0 text-center">
          Subtitle
        </h3> --}}
      </div>
      <div class="row">
        <form action="{{ route('search') }}">
          <div class="dropdown">
            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-price-limit"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Price limit {{ request('filter.price_limit') }}
            </button>
            <div class="dropdown-menu shadow" aria-labelledby="dropdown-price-limit">
              <div class="input-group">
                @unless(null == request('s'))
                  <input type="text" name="s" value="{{ request('s') }}" hidden>
                @endunless
                <input type="number" class="form-control" placeholder="Price limit" aria-describedby="btnGroupAddon"
                  name="filter[price_limit]" value="{{ request('filter.price_limit') }}">
                <button class="bnt" type="submit"><i class="fa fa-check"></i></button>
              </div>
            </div>
          </div>

        </form>
      </div>
      @if (0 < $products->count())
        <div class="row g-2 rounded-3 mb-3 p-3 shadow-sm" style="min-height: 300px">
          @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card p-3">
                <a href="javascript:void(0)" data-hl="{{ base64_encode($product->link) }}">
                  <div class="merchant row">
                    <div class="left col-6">
                      <div class="site fs-7">{{ $product->merchant->site_url }}</div>
                      <div class="rating"></div>
                    </div>
                    <div class="logo col-6 text-end">{{ $product->merchant->name }}</div>
                  </div>
                </a>
                <a href="javascript:void(0)" data-hl="{{ base64_encode($product->link) }}">
                  <div class="card-body">
                    <div class="photo mt-2 mb-4">
                      <img class="w-100 my-auto" src="https://plchldr.co/i/300x250?&bg=eee&fc=333">
                    </div>
                    <div class="name fs-4">{{ $product->name }}</div>
                    <div class="full_category">{{ $product->full_category }}</div>
                    <div class="price">Price: <abbr title="EUR">€</abbr><span>{{ $product->price }}</span>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
        <hr>
        <div id="pagination" class="d-flex d-sm-block justify-content-center">
          {{ $products->withQueryString()->onEachSide(2)->links() }}
        </div>
      @else
        <div class="fs-2">
          <p>Products not found. <a href="{{ route('home') }}">Go to home.</a></p>
        </div>
      @endif
    </div>
  </div>

</x-public.layouts.main>
