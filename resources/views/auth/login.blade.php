@php
$fields = [
    'email' => [
        'input' => [
            'type' => 'email',
            'placeholder' => 'Email',
            'required' => '',
        ],
        'icon' => 'fa fa-envelope',
    ],
    'password' => [
        'input' => [
            'type' => 'password',
            'placeholder' => 'Password',
            'required' => '',
        ],
        'icon' => 'fa fa-asterisk',
    ],
];
@endphp
<x-admin.layouts.box-form :bgImage="asset('/media/photos/photo19@2x.jpg')" title="Sign In" action="" :fields="$fields">
  <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-sm-start mb-4 text-center">
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="login-remember-me" name="remember" checked>
      <label class="form-check-label" for="login-remember-me">Remember Me</label>
    </div>
    <div class="fw-semibold fs-sm py-1">
      <a href="{{ route('password.request') }}">Forgot Password?</a>
    </div>
  </div>
  <x-slot name="button" icon="fa fa-fw fa-sign-in-alt opacity-50 me-1">Sign in</x-slot>
</x-admin.layouts.box-form>
