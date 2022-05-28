<div class="row g-2">
  @isset($queries)
    @foreach ($queries as $q)
      <div class="col-12 col-sm-6 col-md-4">
        <a href="{{ route('search', ['s' => $q['value']]) }}">
          <div class="card overflow-hidden">
            <div class="d-flex">
              <img src="{{ $q['preview'] }}" width="80" height="80" alt="{{ $q['value'] }}">
              <span class="ms-3 text w-100 my-auto">
                {{ $q['value'] }}
              </span>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  @endisset
</div>
