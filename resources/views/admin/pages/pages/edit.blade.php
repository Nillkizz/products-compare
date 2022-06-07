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
          <div class="col-md-11 col-lg-8">
            <form class="row" action="{{ route('admin.pages.update', ['page' => $item]) }}" method="POST">
              @method('PUT')
              @csrf
              <x-form.input name="name" label="Name" :value="$item->name" />
              <x-form.input name="title" label="Title" :value="$item->title" />
              <x-form.input iclass="ps-3" prefix="/" name="path" label="URL Path" :value="$item->path">
                <x-slot name="before_input"><span class="my-auto"
                    style="width: 0; margin-right: -10px; padding-left: 10px; z-index: 100;">/</span></x-slot>
              </x-form.input>

              <div>
                <label class="form-label">Description</label>
                <textarea class="form-control mb-3" name="description" cols="30" rows="5">{{ old('description', $item->description) }}</textarea>
              </div>

              <textarea name="content" id="pageContentField" hidden>{!! old('content', $item->content) !!}</textarea>
              <div class="row row-editor mx-0 mb-4 px-0">
                <div class="editor-container px-0">
                  <div class="editor">
                    {!! old('content', $item->content) !!}
                  </div>
                </div>
              </div>


              <div class="d-flex justify-content-between mb-4">
                <div>
                  <label class="form-label">Published?</label>
                  <div class="form-check form-switch">
                    <label class="form-check-label" for="published"></label>
                    <input class="form-check-input" type="checkbox" value="{{ App\Models\Page::STATUS_PUBLISHED }}"
                      id="published" name="status" @checked($item->status == App\Models\Page::STATUS_PUBLISHED)>
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

    {{-- <script src="{{ mix('static/admin/js/pages/pages/edit.js') }}"></script> --}}
    <script src="{{ mix('static/core/libs/ckeditor-5/ckeditor.js') }}"></script>
    <script>
      (() => {
        const watchdog = new CKSource.EditorWatchdog();

        window.watchdog = watchdog;

        watchdog.setCreator((element, config) => {
          return CKSource.Editor
            .create(element, config)
            .then(editor => {
              $pageContentField = document.getElementById('pageContentField');
              editor.model.document.on('change:data', () => $pageContentField.value = editor.getData())


              return editor;
            })
        });

        watchdog.setDestructor(editor => {



          return editor.destroy();
        });

        watchdog.on('error', handleError);

        watchdog
          .create(document.querySelector('.editor'), {

            licenseKey: '',



          })
          .catch(handleError);

        function handleError(error) {
          console.error('Oops, something went wrong!');
          console.error(
            'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
          );
          console.warn('Build id: y7vp13ncu718-b5c8218ui7tk');
          console.error(error);
        }
      })()
    </script>

  </x-slot>

</x-admin.layouts.admin>
