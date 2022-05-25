@props(['action', 'bgImage' => '', 'bgClass' => 'bg-primary-dark-op', 'title' => 'Box Form', 'method' => 'POST', 'fields' => []])

@php
$bgStyle = $bgImage ? "background-image: url('$bgImage');" : '';

@endphp

<x-admin.layouts.canvas :title="$title">
  <!-- Page Content -->
  <div {{ $attributes->merge(['class' => 'bg-image', 'style' => $bgStyle]) }}>
    <div @class('row g-0 justify-content-center ' . $bgClass)>
      <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center px-sm-0 p-2">
        <!-- Sign In Block -->
        <div class="block-transparent block-rounded w-100 mb-0 block overflow-hidden">
          <div class="block-content block-content-full px-lg-5 px-xl-6 py-md-5 py-lg-6 bg-body-extra-light py-4">
            <!-- Header -->
            <div class="mb-2 text-center">
              <a class="link-fx fw-bold fs-1" href="{{ route('home') }}">
                <x-logo />
              </a>
              <p class="text-uppercase fw-bold fs-sm text-muted">{{ $title }}</p>
            </div>
            <!-- END Header -->
            <x-admin.alert type="success">{{ session('status') }}</x-admin.alert>
            <x-auth.validation-errors :errors="$errors" />
            <!-- Sign In Form -->
            <form class="needs-validation" action="{{ $action }}" method="POST" novalidate>
              @csrf
              <x-admin.fields :fields="$fields" />
              {{ $slot }}
              @isset($button)
                @php
                  $buttonAttributes = $button->attributes
                      ->class(['btn btn-hero btn-primary'])
                      ->merge(['type' => 'submit'])
                      ->whereDoesntStartWith('icon');
                  
                  $iconClasses = 'me-1 opacity-50 ' . $button->attributes['icon'];
                @endphp
                <div class="mb-4 text-center">
                  <button {{ $buttonAttributes }}>
                    @isset($button->attributes['icon'])
                      <i @class($iconClasses)></i>
                    @endisset {{ $button }}
                  </button>
                </div>
              @endisset
            </form>
            <!-- END Sign In Form -->
          </div>
        </div>
        <!-- END Sign In Block -->
      </div>
    </div>
  </div>
  <!-- END Page Content -->

  </x-admin.layouts.admin>
