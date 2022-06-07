@php
use App\Models\Page;
$status_colors = [
    Page::STATUS_PUBLISHED => 'success',
    Page::STATUS_DRAFT => 'muted',
    Page::STATUS_TRASH => 'danger',
];
$getStatusColor = fn($item) => $status_colors[$item->status];

$allItemsCount = $allPagesCount;
$items = $pages;
$name = 'Page';
$itemName = 'page';

$routes = [
    'create' => 'admin.pages.create',
    'edit' => 'admin.pages.edit',
    'show' => 'page',
    'destroy' => 'admin.pages.destroy',
];

$columns = [['name' => 'ID', 'value' => 'id']];

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
                  <th class="d-none d-md-table-cell text-center" style="width: 110px;">Updated at</th>
                  <th>{{ $name }}</th>
                  <th class="d-none d-sm-table-cell text-center" style="width: 110px;">Status</th>
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
                      {{ datetime($item->updated_at, 'd-m-Y') }}</td>
                    <td>{{ $item->name }}</td>

                    <td class="d-none d-sm-table-cell text-center">
                      <span class="badge bg-{{ $getStatusColor($item) }}">{{ $item->status }}</span>
                    </td>

                    <td class="fs-sm text-center">
                      <a class="btn btn-sm btn-alt-secondary"
                        href="{{ route($routes['edit'], [$itemName => $item]) }}" {!! BS::tooltip('Edit', 0) !!}>
                        <i class="fa fa-fw fa-pencil"></i>
                      </a>
                      <a class="btn btn-sm btn-alt-secondary"
                        href="{{ route($routes['show'], ['fallbackPlaceholder' => $item->path]) }}"
                        {!! BS::tooltip('View', 0) !!}>
                        <i class="fa fa-fw fa-eye"></i>
                      </a>

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
          <p>No {{ $name . s }}. <a href="?">Reset filters</a></p>
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
