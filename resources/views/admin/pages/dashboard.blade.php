<x-admin.layouts.admin title="Admin Dashboard">

  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-sm-3 my-2">Dashboard</h1>
        <nav class="my-sm-0 ms-sm-3 my-2 flex-shrink-0" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <div class="row items-push">

      @foreach (Arr::get($data, 'card-counters') as $cardCounter)
        <x-admin.card-counter :props="$cardCounter" />
      @endforeach

    </div>
  </div>

</x-admin.layouts.admin>
