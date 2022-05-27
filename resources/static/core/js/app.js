import './bootstrap';

(($) => {
  $(document.body).on('click', e => {
    const $hl = $(e.target).closest('[data-hl]');
    if (0 == $hl.length) return;
    const url = atob($hl.data('hl'));
    goto(url, true);
  })
})(jQuery)

// Example starter JavaScript for disabling form submissions if there are invalid fields
document.addEventListener('DOMContentLoaded', function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
});