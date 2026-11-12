<?php

// ✅ ねこ登録用のバリデーション

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;



class StoreCatRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

  public function rules(): array {
    return [
      "name" => ["required", "string", "max:50"],
      "breed" => ["required", "string", "max:50"],
      "gender" => ["required", "integer","in:1,2"],
      "date_of_birth" => ["required", "date", "before_or_equal:today"],
      // before_or_equal:today ... 指定した日付が今日以前であること
      "image" => [
        "required",
        "file", // ファイルであること。アップロードされたファイルとして有効かどうか
        "image", // 画像ファイルであること。画像として認識できるか形式かどうか
                 // → ファイルとして有効か？そして、そのファイルが画像か？を確認する
        "max:2000",  // ファイルサイズの上限。2000KBいか
        "mimes:jpeg,jpg,png,avif",
        'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200', 
        // → 画像の解像度が300px * 300px ~ 1200px * 1200px
      ],
      "introduction" => ["required", "string", "max:1000"],
    ];
  }
}
