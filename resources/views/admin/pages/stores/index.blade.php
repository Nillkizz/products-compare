@php
$allItemsCount = $allStoresCount;
$items = $stores;
$name = 'Store';
$itemName = 'store';

$routes = [
    'create' => 'admin.stores.create',
    'edit' => 'admin.stores.edit',
    'show' => 'store',
    'destroy' => 'admin.stores.destroy',
];

@endphp
<x-admin.layouts.admin>
  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <div class="row items-push">
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
        <div class="block-rounded block-link-shadow h-100 mb-0 block text-center">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold text-dark mb-1">{{ $allItemsCount }}</div>
            <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">{{ $name . 's' }}</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="{{ route($routes['create']) }}">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold text-success mb-1">
              <i class="fa fa-plus"></i>
            </div>
            <p class="fw-semibold fs-sm text-success text-uppercase mb-0">
              Add New
            </p>
          </div>
        </a>
      </div>
    </div>
    <!-- END Quick Overview -->

    <!-- All Products -->
    <div class="block-rounded block">
      {{-- <div class="block-header block-header-default">
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
      </div> --}}
      <div class="block-content bg-body-dark">
        <!-- Search Form -->
        <form method="GET" action="">
          <div class="mb-4">
            <div class="input-group">
              <input type="text" class="form-control form-control-alt" id="dm-ecom-products-search" name="s"
                placeholder="Search all {{ $name . 's' }}..." value="{{ request('s') }}">
              <button type="submit" class="btn btn-alt-info">
                <i class="fa fa-fw fa-search opacity-50"></i> <span class="ms-1 d-none d-sm-inline-block">Search</span>
              </button>
            </div>
          </div>
        </form>
        <!-- END Search Form -->
      </div>
      <div>
        <!-- All Products Table -->

        @if ($items->count() > 0)
          <div class="table-responsive">
            <table class="table-borderless table-striped table-vcenter table">
              <thead>
                <tr>
                  <th class="text-center" style="width: 70px;">ID</th>
                  <th class="d-none d-md-table-cell text-center" style="width: 120px">Added</th>
                  <th class="d-none d-md-table-cell text-center" style="width: 200px">Rating</th>
                  <th>Store</th>
                  <th class="d-none d-sm-table-cell text-center" style="width: 160px">Site</th>
                  <th class="d-none d-sm-table-cell text-center" style="width: 100px">Products</th>
                  <th class="text-center" style="width: 150px">Actions</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($items as $item)
                  <tr>
                    <td class="fs-sm text-center">
                      <strong>{{ $item->id }}</strong>
                    </td>
                    <td class="d-none d-md-table-cell fs-sm text-center">
                      {{ datetime($item->created_at, 'd-m-Y') }}</td>
                    <td class="d-none d-md-table-cell">
                      <x-stars class="justify-content-center" :count="$item->reviews_count" :rate="$item->rate" />
                    </td>
                    <td>
                      <a class="fw-semibold d-flex align-items-center gap-2"
                        href="{{ route('store', ['store' => $item]) }}">
                        <div class="badge bg-{{ $item->getStatusValue('color') }} p-1"
                          title="{{ $item->getStatusValue('verbose') }}">
                          <i @class([
                              'd-block',
                              $item->getStatusValue('icon'),
                              'fa-spin' => $item->getStatusValue('value') == 'updating',
                          ]) style="height:10px; width:10px; font-size: 10px"></i>
                        </div>
                        <span>{{ $item->name }}</span>
                      </a>
                    </td>
                    <td class="fw-semibold d-none d-sm-table-cell">
                      {{ $item->site }}
                    </td>
                    <td class="fw-semibold d-none d-sm-table-cell text-center">
                      @if ($item->status == 'updating')
                        {{ $item->update_progress }}
                      @else
                        {{ $item->products->count() }}
                      @endif
                    </td>
                    <td class="fs-sm text-center">
                      <a class="btn btn-sm btn-alt-secondary"
                        href="{{ route($routes['edit'], [$itemName => $item]) }}" {!! BS::tooltip('Edit', 0) !!}>
                        <i class="fa fa-fw fa-pencil"></i>
                      </a>
                      <button class="btn btn-sm btn-alt-secondary" data-clipboard-text="{{ $item->site }}"
                        {!! BS::tooltip('Copy site', 0) !!}>
                        <i class="fa fa-fw fa-link"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-alt-secondary" data-swal-type="delete"
                        data-swal-delete-url="{{ route($routes['destroy'], [$itemName => $item]) }}">
                        <i class="fa fa-fw fa-trash text-danger"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach


              </tbody>
            </table>
          </div>
        @else
          <p>No {{ $name . 's' }}. <a href="?">Reset filters</a></p>
        @endif
        <!-- END All Products Table -->
        {{ $items->onEachSide(1)->links() }}
      </div>
    </div>
    <!-- END All Products -->
  </div>

  <x-slot name="js_before">
  </x-slot>
</x-admin.layouts.admin>
