<x-admin.layouts.admin>
  <!-- Page Content -->
  <div class="content" x-data="app" x-cloak>
    @verbatim
      <div class="card p-3">
        <table class="table-borderless table-striped table-vcenter table">
          <thead>
            <tr>
              <th class="text-center" style="width:110px">Updated</th>
              <th class="text-center">Name</th>
              <th class="d-none d-sm-table-cell" style="width: 100%">Value</th>
              <th class="text-center" style="width: 100px">Actions</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="o in options">
              <tr id="o.name">
                <td class="date fs-sm text-center" x-text="o.updated_at"></td>
                <td class="name fs-sm text-center" x-text="o.name"></td>
                <td class="value d-none d-sm-table-cell" x-text="maxLength(String(o.json.value), 110)"></td>
                <td class="fs-sm text-center">
                  <button class="btn btn-sm btn-outline-primary" @click="editOption(o)">
                    <i class="fa fa-fw fa-edit"></i>
                  </button>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="modal fade" id="changeOption" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="changeOptionModalLabel" aria-hidden="true" x-ref="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="changeOptionModalLabel">Change option "<span
                  x-text="change.optionName"></span>"</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <template x-if="change.type == 'multivalue'">
                <div>
                  <div class="inputs">
                    <template x-for="_, i in change.o.json.value">
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" x-model="change.o.json.value[i]">
                        <button class="btn btn-outline-info fa fa-clock-rotate-left" title="Reset value"
                          @click="change.revert(i)"></button>
                        <button class="btn btn-outline-info fa fa-close" title="Remove"
                          @click="change.dropValue(i)"></button>
                      </div>
                    </template>
                  </div>
                  <button class="btn btn-outline-info w-100" @click="change.addValue()">Add value</button>
                </div>
              </template>

              <template x-if="change.type == 'input'">
                <div class="input-group">
                  <input type="text" class="form-control" x-model="change.o.json.value">
                  <button class="btn btn-outline-info fa fa-clock-rotate-left" title="Reset value"
                    @click="change.addValue()"></button>
                </div>
              </template>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="submit()">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    @endverbatim

    <template x-if="change.o">
      <form :action="window.location.pathname + '/' + change.o.id" method="POST" x-ref="form" class="d-none">
        @method('PUT')
        @csrf
        <input name="json" :value="JSON.stringify(change.o.json)">
      </form>
    </template>
  </div>


  <x-slot name="js_after">
    <script>
      const options = {!! $options !!};
    </script>
    <script src="{{ mix('static/admin/js/pages/site_options.js') }}"></script>
  </x-slot>
</x-admin.layouts.admin>
