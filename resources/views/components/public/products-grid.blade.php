@props(['products'])

@if (0 < $products->count())
  <div class="row g-2 rounded-3 mb-3 bg-white p-3 shadow-sm" style="min-height: 300px">
    @foreach ($products as $product)
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="position-relative card h-100 rounded-1 p-3 pb-2">
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
            <div @class('card-body pb-0')>
              <div class="photo mt-2 mb-4">
                <img class="w-100 rounded-3 h-auto" src="{{ $product->previewUrl('thumb') }}" width="300" height="250"
                  alt="{{ $product->name }}">
              </div>
              <div class="name fs-5">{{ $product->name }}</div>
              <div class="category_full fs-7 text-success">{{ $product->category_full }}</div>
              <div class="price text-danger"><span class="fs-6">Price:</span> <span
                  class="fs-4"><abbr title="EUR">€</abbr><span>{{ $product->price }}</span></span>
              </div>
            </div>
          </a>
          @isset($product->in_stock)
            <div class="position-absolute fs-7 end-0 me-3 bottom-0 mb-2 opacity-50">In Stock:
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
