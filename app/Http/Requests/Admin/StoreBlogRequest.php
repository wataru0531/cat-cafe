<?php

namespace App\Http\Requests\Admin;

// ✅ フォームから送信されたデータを検証(バリデーション)するための専用クラス
// タイトル・画像・本文・カテゴリなどの入力値が正しいかをチェックする役割を持たせる。

// → Controllerでもバリデーションチェックはできるが、Controllerが肥大化するのを防ぐ。

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class StoreBlogRequest extends FormRequest {
  // ✅ このリクエストを実行する権限があるか？ を判定
  public function authorize(): bool {
    return true;
  }

  // ✅ 入力値のバリデーションルールを定義
  public function rules(): array {
    return [
      "title" => ["required", "max:255"],
      "image" => [
        "required",
        "file",  // ファイルであること。アップロードされたファイルとして有効かどうか
        "image", // 画像ファイルであること。画像として認識できるか形式かどうか
        // → ファイルとして有効か？そして、そのファイルが画像か？を確認する
        "max:2000", // ファイルサイズの上限
        "mimes:jpeg,jpg,png,avif",
        'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200', // 画像の解像度が300px * 300px ~ 1200px * 1200px
      ],
      "body" => ["required", "max:20000"], // textarea
    ];
  }
}
