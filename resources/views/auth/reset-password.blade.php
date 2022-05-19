@php
$fields = [
    'password' => [
        'input' => [
            'type' => 'password',
            'placeholder' => 'Password',
            'required' => '',
        ],
    ],
    'password_confirmation' => [
        'input' => [
            'type' => 'password',
            'placeholder' => 'Confirm password',
            'required' => '',
        ],
    ],
];
@endphp
<x-admin.layouts.box-form :action="route('password.update')" :bgImage="asset('/media/photos/photo16@2x.jpg')" title="Reset Password" :fields="$fields">
  <input type="hidden" name="email" value="{{ old('email', $request->email) }}" />
  <input type="hidden" name="token" value="{{ $request->route('token') }}">

  <x-slot name="button" icon="fa fa-fw fa-key ">Reset Password</x-slot>
</x-admin.layouts.box-form>
