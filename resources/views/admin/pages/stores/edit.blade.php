<x-admin.layouts.admin>
  <x-slot name="css_before">
    <link rel="stylesheet" id="css-select2" href="{{ asset('static/core/js/plugins/select2/css/select2.min.css') }}">
  </x-slot>

  <!-- Page Content -->
  <div class="content mb-5">
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
            <form class="row" action="{{ route('admin.stores.update', compact('store')) }}" method="POST"
              enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <x-form.input class="col-3" label="ID" :value="$store->id" readonly />
              <x-form.input class="col-9" name="name" label="Name" :value="$store->name" />
              <x-form.input class="col-sm-6" name="slug" label="Slug" data-type="slug" :value="$store->slug" />
              <x-form.input class="col-sm-6" name="site" label="Site" :value="$store->site" />

              <div class="col-xl-6 row mx-0 mb-4 px-0">
                <div class="col-2 col-xl-4 d-flex justify-content-center position-relative">
                  <img src="{{ $store->logoUrl('h70') }}" alt="Logo" height="70">
                  @unless(empty($store->logoUrl('h70')))
                    <button class="btn btn-outline-danger position-absolute end-0 top-0 p-1 px-2" type="submit"
                      name="action" value="removeLogo"><i class="d-block fa fa-close"></i></button>
                  @endunless
                </div>
                <x-form.input class="col-10 col-xl-8" name="logo" label="Choose a new logo" type="file" />
              </div>

              <div class="col-xl-6 mb-4">
                <label class="form-label" for="store-xml_url">XML Url</label>
                <div class="input-group" x-data="{ changed: false }">
                  <input type="text" class="form-control" id="store-xml_url" name="xml_url"
                    value="{{ old('xml_url', $store->xml_url) }}" @@change="changed=true">
                  <a class="btn btn-outline-primary" :disabled="changed"
                    @@click="e=>{ if (changed) {swal.fire('First save changes!'); e.preventDefault() } }"
                    href="{{ route('admin.store.do_xml_import_products', compact('store')) }}">Import now</a>
                </div>
              </div>

              <div class="row contacts mx-0 mb-4 px-0" x-data="Laravel.editStore">
                <script>
                  Laravel.editStore = {
                    contacts: {{ Js::from($store->contacts) }}
                  };
                </script>
                <div class="form-label">Contacts</div>
                <template x-for="c, idx in contacts">
                  <div class="input-group with_btn mb-3">
                    <input class="form-control" type="text" x-model="c.value" :name="`contacts[${idx}][value]`">

                    <select class="form-select" id="example-select" :name="`contacts[${idx}][type]`"
                      x-model="c.type">
                      @foreach ($store::contactTypes as $ct)
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
                    <label class="form-check-label" for="store-published"></label>
                    <input class="form-check-input" type="checkbox" value="1" id="store-published" name="published"
                      @checked($store->published)>
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




    <section class="reviews card card-body">
      <div class="heading">
        <h2 class="d-inline-block fs-5">Reviews</h2> <span class="count">{{ $reviews_count }}</span>
      </div>
      <div class="reviews_statistics">
        <div class="bar">
          @foreach ($store->getReviewsReport() as $stars => $rr)
            @if ($rr['count'] > 0)
              <a class="d-flex reviews-col stars{{ $stars }} gap-1" style="width:{{ $rr['percent'] }}%"
                href="{{ route('admin.stores.edit', compact('store', 'stars')) }}" title="{{ $rr['text'] }}">
                @if ($rr['percent'] > 10)
                  <span class="ms-1 fw-bold">{{ $stars }}</span>
                @endif
                @if ($rr['percent'] > 20)
                  <i class="fa fa-star fs-8"></i>
                @endif
                @if ($rr['percent'] > 30)
                  <span class="fs-7">{{ $rr['percent'] }}%</span>
                @endif
              </a>
            @endif
          @endforeach
        </div>
        @unless(empty($reviews_stars_filter))
          <div>Showed reviews with {{ $reviews_stars_filter }} stars.<br> You can <a
              href="{{ route('admin.stores.edit', compact('store')) }}">reset filter</a> for show all
            reviews.</div>
        @endunless
        <hr>
      </div>
      <div class="reviews-list">
        @foreach ($reviews as $review)
          <div @class([
              'alert alert-warning' => $review->isModeration(),
              'review-item',
          ])>
            <div class="d-flex align-items-baseline flex-wrap gap-2">
              <div class="d-inline-block stars-wrapper">
                <x-stars class="" :rate="$review->stars" :hideCount="true" />
              </div>
              <div class="d-inline-block date text-muted">{{ $review->created_at->format('Y-m-d') }}</div>
              <div class="controls d-flex ms-1 gap-2" data-review-id="{{ $review->id }}">
                @switch($review->status)
                  @case($review::STATUS['moderation']['value'])
                    <button type="button" class="btn btn-sm btn-outline-success" data-action="publish">Publish</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-action="delete">Delete</button>
                  @break

                  @case($review::STATUS['published']['value'])
                    <button type="button" class="btn btn-sm btn-outline-warning" data-action="moderate">Moderate</button>
                  @break
                @endswitch
              </div>
            </div>
            <div class="text mb-2">
              {{ $review->text }}
            </div>
            <div class="questions">
              @foreach ($review->questions as $question)
                <div @class([
                    'question',
                    'text-success' => $question['answer'],
                    'text-danger' => !$question['answer'],
                ])>{{ $question['text'] }}</div>
              @endforeach
            </div>
          </div>
          <hr>
        @endforeach
        <div id="pagination" class="d-flex d-sm-block justify-content-center">
          {{ $reviews->withQueryString()->onEachSide(2)->links() }}
        </div>
      </div>
    </section>




  </div>
  <!-- END Page Content -->

  <x-slot name="js_after">
    <script src="{{ asset('static/core/js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ mix('static/admin/js/pages/stores/edit.js') }}"></script>
  </x-slot>

</x-admin.layouts.admin>
