<div class="position-relative position-sm-static">

  <div id="page-header-search" class="overlay-header bg-transparent">
    <div class="ms-auto col-sm-8">
      <form class="w-100 rounded border" action="be_pages_generic_search.php" method="POST">
        <div class="input-group">
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-alt-primary" data-toggle="layout" data-action="header_search_off">
            <i class="fa fa-fw fa-times-circle"></i>
          </button>
          <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
            id="page-header-search-input" name="page-header-search-input">
        </div>
      </form>
    </div>
  </div>
  <button type="button" class="btn btn-alt-secondary w-100 w-sm-auto" data-toggle="layout"
    data-action="header_search_on">
    <i class="fa fa-fw fa-search opacity-50"></i> <span class="ms-1 d-inline-block">Search</span>
  </button>
  <button type="button" class="btn btn-alt-secondary d-lg-none ms-1" data-toggle="layout" data-action="sidebar_toggle">
    <i class="fa fa-fw fa-bars"></i>
  </button>

</div>
