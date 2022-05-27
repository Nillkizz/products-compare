@if (session('notify'))
  <script>
    Dashmix.helpers('jq-notify', {
      type: '{{ session('notify')['status'] ?? 'success' }}',
      icon: 'fa {{ session('notify')['icon'] ?? '' }}',
      message: '{{ session('notify')['text'] ?? usfirst(session('notify')['status'] ?? 'Success') }}'
    });
  </script>
@endif
