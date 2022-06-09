@props(['products'])

@if (0 < $products->count())
  <div class="row g-2 rounded-3 mb-3 bg-white p-3 shadow-sm" style="min-height: 300px">
    @foreach ($products as $product)
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="position-relative product card h-100 rounded-1 p-3 pb-2">
          <a href="{{ route('store', ['slug' => $product->store->slug]) }}">
            <div class="store row">
              <div class="left col-6">
                <div class="site fs-8 mb-1">{{ $product->store->site }}</div>
                <x-stars class="fs-7 me-auto" :count="$product->store->reviews_count" :rate="$product->store->rate" />
              </div>
              <div class="logo text-end col-6">
                @unless(empty($product->store->logoUrl('h35')))
                  <img src="{{ $product->store->logoUrl('h35') }}" alt="{{ $product->store->name }}">
                @endunless
              </div>
            </div>
          </a>
          <a href="{{ route('goto_product', ['product' => $product, 'search' => request()->input('s')]) }}">
            <div @class('card-body pb-0')>
              <div class="photo mt-2 mb-4">
                <img class="w-100 rounded-3 h-auto" src="{{ $product->previewUrl('210x210') }}" width="205"
                  height="205" alt="{{ $product->name }}">
              </div>
              <div class="name">{{ $product->name }}</div>
              <div class="category_full text-success">{{ $product->category_full }}</div>
              <div class="price text-danger"><span class="fs-6">Price:</span> <span
                  class="fs-4"><abbr title="EUR">€</abbr><span>{{ $product->price }}</span></span>
              </div>
              <div class="delivery"></div>
            </div>
          </a>
          @isset($product->in_stock)
            <div class="position-absolute stock end-0 me-3 bottom-0 mb-2 opacity-50">In Stock:
              {{ $product->in_stock }}
            </div>
          @endisset
        </div>
      </div>
    @endforeach
  </div>
  <hr>
  <div id="pagination" class="d-flex d-sm-block justify-content-center">
    {{ $products->withQueryString()->onEachSide(2)->links() }}
  </div>
@endif
