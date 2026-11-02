<?php

// ✅ ユーザー更新時のRequest

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
      return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
      return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        // → 編集の時は必須ではない
        'image' => [
          'nullable', // ⭐️ 更新時はnullableでOK
          'file', // ファイルがアップロードされている
          'image', // 画像ファイルである
          'max:5120', // ファイル容量が5Mb以下である
          'mimes:jpeg,jpg,png,avif', // 形式はjpegかpng
          'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // 画像の解像度が100px * 100px ~ 300px * 300px
        ],
        'introduction' => ['required', 'string', 'max:255'],
      ];
    }

    public function attributes() {
      return [
        "introduction" => "自己紹介文",
      ];
    }
}
