@props(['fields'])
@foreach ($fields as $field_name => $field)
  @php
    $wrapper = $field['wrapper'] ?? [];
    $input = $field['input'] ?? [];
    $input['name'] = $field_name;
    
    $icon = $field['icon'] ?? '';
  @endphp
  <x-admin.field :wrapper="$wrapper" :input="$input" :icon="$icon" />
@endforeach
