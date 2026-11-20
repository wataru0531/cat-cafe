<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest {
  public function authorize(): bool {
      return true;
  }

  public function rules(): array {
    return [
      "name" => ["required", "string", "max:255"],
      "image" => [
        "required",
        "image",
        "mimes:jpg,jpeg,png,webp,avif,gif",
        "max:5120",
        "dimensions:max_width=6000,max_height=6000",
      ]
    ];
  }
}
