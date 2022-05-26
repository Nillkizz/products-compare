<x-admin.layouts.admin>
  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <div class="row items-push">
      {{-- <div class="col-6 col-lg-3">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="be_pages_ecom_product_edit.php">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold text-success mb-1">
              <i class="fa fa-plus"></i>
            </div>
            <p class="fw-semibold fs-sm text-success text-uppercase mb-0">
              Add New
            </p>
          </div>
        </a>
      </div> --}}
      {{-- <div class="col-6 col-lg-3">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="javascript:void(0)">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold text-danger mb-1">63</div>
            <p class="fw-semibold fs-sm text-danger text-uppercase mb-0">
              Out of stock
            </p>
          </div>
        </a>
      </div> --}}
      {{-- <div class="col-6 col-lg-3">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="javascript:void(0)">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold text-dark mb-1">690</div>
            <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
              New
            </p>
          </div>
        </a>
      </div> --}}
      <div class="col-6 col-lg-3">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="javascript:void(0)">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold text-dark mb-1">{{ $allProductsCount }}</div>
            <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
              All Products
            </p>
          </div>
        </a>
      </div>
    </div>
    <!-- END Quick Overview -->

    <!-- All Products -->
    <div class="block-rounded block">
      <div class="block-header block-header-default">
        <h3 class="block-title">All Products</h3>
        <div class="block-options">
          <div class="dropdown">
            <button type="button" class="btn btn-alt-secondary" id="dropdown-ecom-filters" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Filters <i class="fa fa-angle-down ms-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters" style="">
              @foreach ($filters as $filter)
                <a class="dropdown-item d-flex align-items-center justify-content-between"
                  href="{{ $filter['link'] }}">
                  {{ $filter['name'] }}
                  @isset($filter['badge'])
                    <span class="badge bg-black-50 rounded-pill">{{ $filter['badge']['val'] }}</span>
                  @endisset
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="block-content bg-body-dark">
        <!-- Search Form -->
        <form method="GET" action="">
          <div class="mb-4">
            <div class="input-group">
              <input type="text" class="form-control form-control-alt" id="dm-ecom-products-search" name="s"
                placeholder="Search all products.." value="{{ request('s') }}">
              <button type="submit" class="btn btn-alt-info">
                <i class="fa fa-fw fa-search opacity-50"></i> <span class="ms-1 d-none d-sm-inline-block">Search</span>
              </button>
            </div>
          </div>
        </form>
        <!-- END Search Form -->
      </div>
      <div class="block-content">
        <!-- All Products Table -->

        @if ($products->count() > 0)
          <div class="table-responsive">
            <table class="table-borderless table-striped table-vcenter table">
              <thead>
                <tr>
                  <th class="text-center" style="width: 70px;">ID</th>
                  <th class="d-none d-sm-table-cell text-center">Added</th>
                  <th>Product</th>
                  <th class="d-none d-md-table-cell">Merchant</th>
                  <th class="d-none d-sm-table-cell text-end">Price</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($products as $product)
                  <tr>
                    <td class="fs-sm text-center">
                      <a class="fw-semibold" href="be_pages_ecom_product_edit.php">
                        <strong>{{ $product->id }}</strong>
                      </a>
                    </td>
                    <td class="d-none d-sm-table-cell fs-sm text-center">
                      {{ datetime($product->created_at, 'd-m-Y') }}</td>
                    <td>
                      <a class="fw-semibold" href="{{ $product->link }}">{{ $product->name }}</a>
                    </td>
                    <td class="d-none d-md-table-cell">
                      {{-- TODO: Change url to front merchant --}}
                      <a href="{{ $product->link }}">{{ $product->merchant->name }}</a>
                    </td>
                    <td class="text-end d-none d-sm-table-cell fs-sm">
                      <strong>€{{ $product->price }}</strong>
                    </td>
                    <td class="fs-sm text-center">
                      <button class="btn btn-sm btn-alt-secondary" data-clipboard-text="{{ $product->link }}">
                        <i class="fa fa-fw fa-link"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach


              </tbody>
            </table>
          </div>
        @else
          <p>No products. <a href="?">Reset filters</a></p>
        @endif
        <!-- END All Products Table -->
        {{ $products->onEachSide(1)->links() }}
      </div>
    </div>
    <!-- END All Products -->
  </div>
</x-admin.layouts.admin>
