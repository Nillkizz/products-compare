<div class="row g-2">
  @isset($queries)
    @foreach ($queries as $q)
      <div class="col-12 col-sm-6 col-md-4">
        <a href="{{ route('search', ['s' => $q['value']]) }}">
          <div class="card overflow-hidden">
            <div class="d-flex">
              <img class="rounded-4 m-2" src="{{ $q['preview'] }}" width="60" height="60" alt="{{ $q['value'] }}">
              <span class="ms-3 text w-100 my-auto" style="max-height: 4.8rem;">
                {{ $q['value'] }}
              </span>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  @endisset
</div>
