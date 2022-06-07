<x-public.layouts.main>
  <div class="bg-body-extra-light">
    <div class="content content-full">
      <div class="push mb-5">
        <h2 class="text-center">Featured</h2>
      </div>
      <x-public.queries-grid :queries="$featuredQueries" />
    </div>
  </div>
  <div class="bg-body-light">
    <div class="content content-full">
      <p>
        {!! $page->content !!}
      </p>
    </div>
  </div>
</x-public.layouts.main>
