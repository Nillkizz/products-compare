<?php

namespace App\Http\Requests\Admin\Pages;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageFormRequest extends FormRequest
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
      'name' => 'required|string|max:128',
      'title' => 'string|max:128',
      'path' => 'string|unique:pages',
      'template' => [
        'required', 'string',
        Rule::in(Page::getTemplates())
      ],
      'description' => 'string|max:500',
      'content' => 'string',
      'status' => Rule::in(Page::STATUSES)
    ];
  }
  protected function prepareForValidation()
  {
    $this->merge([
      'title' => $this->get('data') ?? $this->get('name'),
      'path' => $this->get('path') ?? '',
      'status' => $this->get('status') ?? 'draft',
      'content' => $this->get('content') ?? '',
    ]);
  }
}
