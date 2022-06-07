<footer class="fs-sm mt-4 pt-3">
  <ul class="nav justify-content-center border-bottom mb-3 pb-3">
    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-muted px-2">Home</a></li>
    <li class="nav-item"><a href="{{ route('page', ['path' => 'for_shops']) }}"
        class="nav-link text-muted px-2">For
        shops</a></li>
    <li class="nav-item"><a href="{{ route('page', ['path' => 'privacy_policy']) }}"
        class="nav-link text-muted px-2">Privacy</a></li>
    <li class="nav-item"><a href="{{ route('page', ['path' => 'about_us']) }}"
        class="nav-link text-muted px-2">About</a></li>
  </ul>
  <p class="text-muted text-center">&copy; <span data-toggle="year-copy"></span> PCMpare</p>
</footer>
