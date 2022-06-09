<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreReviewRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return !in_array($this->store->id, session('reviewed-stores', []));
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'stars' => 'required|numeric',
      'questions' => 'array',
      'questions.*.text' => "string",
      'questions.*.question' => "string",
      'questions.*.answer' => "string",
      'text' => 'string'
    ];
  }
  protected function prepareForValidation()
  {
    $this->merge([
      'questions' => $this->input('questions', []),
      'text' => $this->input('text', '')
    ]);
  }
}
