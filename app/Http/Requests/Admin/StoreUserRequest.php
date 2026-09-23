<?php

namespace App\Http\Requests\Admin;

// Requestフォルダ群
// → ユーザーが送信したデータを検証（バリデーション）するためのクラスを管理する場所

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class StoreUserRequest extends FormRequest {
  // ✅ このリクエストを実行したいいかどうか。
  // → デフォルトではfalseなのでtrueに変更する
  public function authorize(): bool {
    return true;
  }

  public function rules(): array {
    return [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'image' => [
        'required',
        'file', // ファイルがアップロードされている
        'image', // 画像ファイルである
        'max:5120', // ファイル容量が5Mb以下である
        'mimes:jpeg,jpg,png', // 形式はjpegかpng
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
