document.addEventListener('DOMContentLoaded', () => {
  if (trim(window.location.pathname, '/') !== 'search') return;

  const $filters = document.getElementById('filters');
  const $sortInput = $filters.elements['sort'];

  const sortButtons = $filters.querySelectorAll('[data-sort]');
  const actionButtons = $filters.querySelectorAll('[data-action]');


  Array.from(actionButtons).forEach(actionsHandler);
  Array.from(sortButtons).forEach(sortHandler);


  function sortHandler($b) {
    $b.addEventListener('click', submitWrapper(() => $sortInput.value = $b.dataset.sort))
  }

  function actionsHandler($b) {
    switch ($b.dataset.action) {
      case 'reset':
        $b.addEventListener('click', submitWrapper(() => {
          const search = new URL(window.location.href).searchParams.get('s');
          goto('?s=' + search)
        }))
        break;
    }
  }

  function submitWrapper(cb) {
    return () => { cb(); $filters.submit(); }
  };
})