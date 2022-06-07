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
              <x-form.input class="col-3" label="ID" :value="$merchant->id" readonly />
              <x-form.input class="col-9" name="name" label="Name" :value="$merchant->name" />
              <x-form.input class="col-sm-6" name="slug" label="Slug" data-type="slug" :value="$merchant->slug" />
              <x-form.input class="col-sm-6" name="site" label="Site" :value="$merchant->site" />

              <div class="col-xl-6 row mx-0 mb-4 px-0">
                <div class="col-2 col-xl-4 d-flex justify-content-center">
                  <img src="{{ $merchant->logoUrl('h70') }}" alt="Logo" height="70">
                </div>
                <x-form.input class="col-10 col-xl-8" name="logo" label="Choose a new logo" type="file" />
              </div>

              <div class="col-xl-6 mb-4">
                <label class="form-label" for="merchant-xml_url">XML Url</label>
                <div class="input-group" x-data="{ changed: false }">
                  <input type="text" class="form-control" id="merchant-xml_url" name="xml_url"
                    value="{{ old('xml_url', $merchant->xml_url) }}" @@change="changed=true">
                  <a class="btn btn-outline-primary" :disabled="changed"
                    @@click="e=>{ if (changed) {swal.fire('First save changes!'); e.preventDefault() } }"
                    href="{{ route('admin.merchant.do_xml_import_products', compact('merchant')) }}">Import now</a>
                </div>
              </div>

              <div class="row contacts mx-0 mb-4 px-0" x-data="Laravel.editMerchant">
                <script>
                  Laravel.editMerchant = {
                    contacts: {{ Js::from($merchant->contacts) }}
                  };
                </script>
                <div class="form-label">Contacts</div>
                <template x-for="c, idx in contacts">
                  <div class="input-group with_btn mb-3">
                    <input class="form-control" type="text" x-model="c.value" :name="`contacts[${idx}][value]`">

                    <select class="form-select" id="example-select" :name="`contacts[${idx}][type]`"
                      x-model="c.type">
                      @foreach ($merchant::contactTypes as $ct)
                        <option value="{{ $ct['value'] }}" :selected="'{{ $ct['value'] }}' == c.type">
                          {{ $ct['verbose'] }}
                        </option>
                      @endforeach
                    </select>
                    <button class="btn btn-outline-danger" type="button"
                      @@click="contacts = contacts.filter( (_, i) => idx != i )"><i
                        class="fa fa-close"></i></button>
                  </div>
                </template>
                <div class="contacts__bottom px-3">
                  <button class="btn btn-outline-secondary w-100" type="button"
                    @@click="contacts.push({value: '', contact_type_id: 1})">Add
                    contact</button>
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

  </div>
  <!-- END Page Content -->

  <x-slot name="js_after">
    <script src="{{ asset('static/core/js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ mix('static/admin/js/pages/merchants/edit.js') }}"></script>
  </x-slot>

</x-admin.layouts.admin>
