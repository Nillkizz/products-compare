<x-admin.layouts.admin>
  <x-slot name="css_before">
    <link rel="stylesheet" id="css-select2" href="{{ asset('static/core/js/plugins/select2/css/select2.min.css') }}">
  </x-slot>

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview + Actions -->
    {{-- <div class="row items-push">
      <div class="col-6 col-lg-4">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="be_pages_ecom_orders.php">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold mb-1">250</div>
            <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
              Pending
            </p>
          </div>
        </a>
      </div>
      <div class="col-6 col-lg-4">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="javascript:void(0)">
          <div class="block-content py-5">
            <div class="fs-3 fw-semibold mb-1">29</div>
            <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
              Available
            </p>
          </div>
        </a>
      </div>
      <div class="col-lg-4">
        <a class="block-rounded block-link-shadow h-100 mb-0 block text-center" href="be_pages_ecom_product_edit.php">
          <div class="block-content py-5">
            <div class="fs-3 text-danger mb-1">
              <i class="fa fa-times"></i>
            </div>
            <p class="fw-semibold fs-sm text-danger text-uppercase mb-0">
              Remove Product
            </p>
          </div>
        </a>
      </div>
    </div> --}}
    <!-- END Quick Overview + Actions -->

    <!-- Info -->
    <div class="block-rounded block">
      <div class="block-header block-header-default">
        <h3 class="block-title">Info</h3>
      </div>
      <div class="block-content">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="row justify-content-center">
          <div class="col-md-10 col-lg-8">
            <form class="row" action="{{ route('admin.merchants.update', compact('merchant')) }}"
              method="POST" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="col-3 mb-4">
                <label class="form-label" for="merchant-id">ID</label>
                <input type="text" class="form-control" id="merchant-id" value="{{ $merchant->id }}" readonly>
              </div>
              <div class="col-9 mb-4">
                <label class="form-label" for="merchant-name">Name</label>
                <input type="text" class="form-control" id="merchant-name" name="name"
                  value="{{ old('name', $merchant->name) }}">
              </div>
              <div class="mb-4">
                <label class="form-label" for="merchant-slug">Slug</label>
                <input type="text" class="form-control" id="merchant-slug" name="slug" data-type="slug"
                  value="{{ old('slug', $merchant->slug) }}">
              </div>
              <div class="mb-4">
                <label class="form-label" for="merchant-site">Site</label>
                <input type="text" class="form-control" id="merchant-site" name="site"
                  value="{{ old('site', $merchant->site) }}">
              </div>
              <div class="mb-4">
                {{-- TODO: Add button for manual import --}}
                <label class="form-label" for="merchant-xml_url">XML Url</label>
                <input type="text" class="form-control" id="merchant-xml_url" name="xml_url"
                  value="{{ old('xml_url', $merchant->xml_url) }}">
              </div>

              <div class="row mx-0 mb-4 px-0">
                <div class="col-2">
                  <img src="{{ $merchant->getFirstMediaUrl('logo', 'medium') }}" alt="Logo">
                </div>
                <div class="col-10">
                  <label class="form-label" for="merchant-logo">Choose a new logo</label>
                  <input class="form-control" type="file" id="merchant-logo" name="logo">
                </div>
              </div>

              <div class="d-flex justify-content-between mb-4">
                <div>
                  <label class="form-label">Published?</label>
                  <div class="form-check form-switch">
                    <label class="form-check-label" for="merchant-published"></label>
                    <input class="form-check-input" type="checkbox" value="1" id="merchant-published" name="published"
                      @checked($merchant->published)>
                  </div>
                </div>
                <button type="submit" class="btn btn-alt-primary mt-auto">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END Info -->

    <!-- Meta Data -->
    <div class="block-rounded block">
      <div class="block-header block-header-default">
        <h3 class="block-title">Meta Data</h3>
      </div>
      <div class="block-content">
        <div class="row justify-content-center">

          <div class="col-md-10 col-lg-8">
            <form action="be_pages_ecom_product_edit.php" method="POST" onsubmit="return false;">

              <div class="d-flex justify-content-between mb-4">
                <div></div>
                <button type="submit" class="btn btn-alt-primary mt-auto">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END Meta Data -->

  </div>
  <!-- END Page Content -->

  <x-slot name="js_after">
    <script src="{{ asset('static/core/js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ mix('static/admin/js/pages/merchants/edit.js') }}"></script>
  </x-slot>

</x-admin.layouts.admin>
