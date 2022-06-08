<meta name="referrer" content="origin">
<meta http-equiv="Refresh" content="1; url={{ $target_url }}">

<script>
  if ("localStorage" in window) {
    var current_clicks = localStorage.getItem('click');
    if (current_clicks === null) {
      current_clicks = '';
    }
    var data = [];
    try {
      data = JSON.parse(current_clicks);
    } catch (e) {}

    var foo = [];
    var max_ts_diff = 1000 * 60 * 60 * 24 * 365;
    for (var i = 0; i < data.length; i++) {
      if (Date.now() - data[i].time < max_ts_diff) {
        foo.push(data[i]);
      }
    }
    data = foo;
    var exists = false;
    for (var i = 0; i < data.length; i++) {
      if (data[i].shop == {{ $site }}) {
        exists = true;
        break;
      }
    }
    if (exists == false) {
      data.push({
        shop: '{{ $site }}',
        time: Date.now()
      });
    }
    localStorage.setItem('click', JSON.stringify(data));
  }
</script>
<script>
  window.location = "{{ $target_url }}";
</script>
