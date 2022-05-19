@props(['errors'])

@if ($errors->any())
  <x-admin.alert type="danger">
    <div class="text-center">
      <strong>{{ __('Whoops! Something went wrong.') }}</strong>
    </div>

    <ul class="mt-3 list-inside list-disc text-sm text-red-600">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </x-admin.alert>
@endif
