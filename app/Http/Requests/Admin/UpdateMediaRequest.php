<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255"]
        ];
    }
}
