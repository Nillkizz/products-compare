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
];
@endphp
<x-admin.layouts.box-form :bgImage="asset('/media/photos/photo16@2x.jpg')" title="Password Reminder" :action="route('password.email')" :fields="$fields">
  <x-slot name="button" icon="fa fa-fw fa-reply ">Reset Password</x-slot>
</x-admin.layouts.box-form>
