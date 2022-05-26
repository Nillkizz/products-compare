<x-public.layouts.main>
  <div class="bg-body-extra-light">
    <div class="content content-full">
      <div class="push mb-5">
        <h2 class="text-center">Featured</h2>
        {{-- <h3 class="text-muted mb-0 text-center">
          Subtitle
        </h3> --}}
      </div>
      <div class="row g-2">
        @isset($featuredCategories)
          @foreach ($featuredCategories as $cat)
            <div class="col-6 col-sm-4">
              <a href="{{ route('search', ['s' => $cat]) }}">
                <div class="card">
                  <div class="d-flex">
                    <img class="" src="https://plchldr.co/i/80x80?&bg=eee&fc=333">
                    <span class="ms-3 text w-100 my-auto">
                      {{ $cat }}
                    </span>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        @endisset
      </div>
    </div>
  </div>

  <!-- Section 3 -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="push py-5">
        <h2 class="mb-2 text-center">
          Title 3
        </h2>
        <h3 class="text-muted mb-0 text-center">
          Subtitle
        </h3>
      </div>
      <div class="text-center">
        <p>
          Your content..
        </p>
      </div>
    </div>
  </div>
  <!-- END Section 3 -->


</x-public.layouts.main>
