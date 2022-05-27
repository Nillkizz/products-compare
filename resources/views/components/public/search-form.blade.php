<form {{ $attributes->merge() }} action="{{ route('search') }}" method="get">
  <div class="input-group rounded border">
    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
    <input type="text" class="form-control border-0" placeholder="Search or hit ESC.." id="page-header-search-input"
      name="s" value="{{ request('s') }}">
    <button type="submit" class="btn btn-alt-primary">
      <i class="fa fa-fw fa-search"></i>
    </button>
  </div>
</form>
