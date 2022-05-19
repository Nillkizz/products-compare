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

      <x-admin.card-counter class="col-3" icon="fa-box" title="Products" value="213" link="Go to products"
        url="/products" />

      <x-admin.card class="col-md-6 col-xl-4">
        <x-slot name="header">
          Block Title
        </x-slot>
        <p>
          ...
        </p>
      </x-admin.card>
    </div>
  </div>

</x-admin.layouts.admin>
