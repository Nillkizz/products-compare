import './bootstrap';

new ClipboardJS('[data-clipboard-text]').on('success', (e) => { Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: 'Copied!' }); });
(new InputHandlers()).init();
Dashmix.helpersOnLoad(['swal']);


(() => {
  class Dialogs {
    constructor() {
      this.toast = Swal.mixin({
        buttonsStyling: false,
        target: '#page-container',
        customClass: {
          confirmButton: 'btn btn-success m-1',
          cancelButton: 'btn btn-danger m-1',
          input: 'form-control'
        }
      });
    }

    sweetAlert2() {
      Array.from(document.querySelectorAll('[data-swal-type]')).forEach(this.listen.bind(this))
      // Set default properties

      // // Init a simple dialog on button click
      // document.querySelector('.js-swal-simple').addEventListener('click', e => {
      //   toast.fire('Hi, this is just a simple message!');
      // });

      // // Init an success dialog on button click
      // document.querySelector('.js-swal-success').addEventListener('click', e => {
      //   toast.fire('Success', 'Everything was updated perfectly!', 'success');
      // });

      // // Init an info dialog on button click
      // document.querySelector('.js-swal-info').addEventListener('click', e => {
      //   toast.fire('Info', 'Just an informational message!', 'info');
      // });

      // // Init an warning dialog on button click
      // document.querySelector('.js-swal-warning').addEventListener('click', e => {
      //   toast.fire('Warning', 'Something needs your attention!', 'warning');
      // });

      // // Init an error dialog on button click
      // document.querySelector('.js-swal-error').addEventListener('click', e => {
      //   toast.fire('Oops...', 'Something went wrong!', 'error');
      // });

      // // Init an question dialog on button click
      // document.querySelector('.js-swal-question').addEventListener('click', e => {
      //   toast.fire('Question', 'Are you sure about that?', 'question');
      // });

      // Init an example confirm dialog on button click

      // // Init an example confirm alert on button click
      // document.querySelector('.js-swal-custom-position').addEventListener('click', e => {
      //   toast.fire({
      //     position: 'top-end',
      //     title: 'Perfect!',
      //     text: 'Nice Position!',
      //     icon: 'success'
      //   });
      // });
    }

    listen($e) {
      switch ($e.dataset.swalType) {
        case ('delete'): return $e.addEventListener('click', () => this.delete($e));
      }
    }

    delete($e) {
      const toast = this.toast;
      toast.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover it!',
        icon: 'warning',
        showCancelButton: true,
        customClass: {
          confirmButton: 'btn btn-danger m-1',
          cancelButton: 'btn btn-secondary m-1'
        },
        confirmButtonText: 'Yes, delete it!',
        html: false,
        preConfirm: _ => {
        }
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Deleting',
            html: 'Please wait...',
            timer: 1500,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
            },
          }).then(() => {
            const deleteUrl = $e.dataset.swalDeleteUrl;
            axios.delete(deleteUrl, { body: { _token: Laravel.csrfToken, _method: 'delete' } }).then(() => window.location.reload())
          })
        }
      });

    }


    /*
     * Init functionality
     *
     */
    init() {
      this.sweetAlert2();
    }
  }

  // Initialize when page loads
  Dashmix.onLoad(new Dialogs().init());

})();