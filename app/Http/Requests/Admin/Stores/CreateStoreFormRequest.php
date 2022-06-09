<?php

namespace App\Http\Requests\Admin\Stores;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreateStoreFormRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|max:255',
      'published' => 'required|boolean',
      'logo' => 'nullable|image',
      'slug' => [
        'required', 'max:255',
        Rule::unique('stores'),
        ''
      ],
      'site' => [
        'required', 'max:255',
        Rule::unique('stores'),
        function ($attribute, $value, $fail) {
          $ip = gethostbyname($value);
          if (!filter_var($ip, FILTER_VALIDATE_IP)) $fail(Str::ucfirst($attribute) . " domain is not regitered.");
        }
      ],
      'xml_url' => [
        'required', 'URL',
        Rule::unique('stores'),
      ],
      'contacts' => 'array',

      'contacts.*.value' => 'required|string',
      'contacts.*.type' => [
        'required',
        Rule::in(Arr::pluck(Store::contactTypes, 'value')),
      ]

    ];
  }

  public function validationData()
  {
    $data = $this->all();
    $data['published'] = $this->has('published');
    if ($this->missing('contacts')) $data['contacts'] = [];
    return $data;
  }
}
