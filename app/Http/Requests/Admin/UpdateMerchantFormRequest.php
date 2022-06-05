<?php

namespace App\Http\Requests\Admin;

use App\Models\ContactType;
use App\Models\Merchant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateMerchantFormRequest extends FormRequest
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
    $merchant_id = $this->merchant->id;
    return [
      'name' => 'required|max:255',
      'published' => 'required|boolean',
      'logo' => 'nullable|image',
      'slug' => [
        'required', 'max:255',
        Rule::unique('merchants')->ignore($merchant_id),
        ''
      ],
      'site' => [
        'required', 'max:255',
        Rule::unique('merchants')->ignore($merchant_id),
      ],
      'xml_url' => [
        'required', 'URL',
        Rule::unique('merchants')->ignore($merchant_id),
      ],
      'contacts' => 'array',

      'contacts.*.value' => 'required|string',
      'contacts.*.type' => [
        'required',
        Rule::in(Arr::pluck(Merchant::contactTypes, 'value')),
      ]

    ];
  }

  public function validationData()
  {
    $data = $this->all();
    $data['published'] = $this->has('published');
    return $data;
  }
}
