<x-admin.layouts.admin>
  <!-- Page Content -->
  <div class="content">
    <div class="row items-push">

      @foreach (Arr::get($data, 'card-counters') as $cardCounter)
        <x-admin.card-counter :props="$cardCounter" />
      @endforeach

    </div>
  </div>

</x-admin.layouts.admin>
