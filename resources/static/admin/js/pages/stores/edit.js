document.addEventListener('DOMContentLoaded', () => {
  const $actions = document.querySelectorAll('.review-item [data-action]')
  Array.from($actions).forEach($action => {
    $action.addEventListener('click', e => {
      const reviewId = e.target.closest('[data-review-id]').dataset.reviewId;
      const action = e.target.dataset.action;

      if (action == 'delete') axios.delete(`/admin/store-reviews/${reviewId}`, { body: { _token: Laravel.csrfToken, _method: 'delete' } }).then(() => window.location.reload());
      else axios.post(`/admin/store-reviews/${reviewId}/action`, { body: { _token: Laravel.csrfToken, action } }).then(() => window.location.reload())
    })
  });
})