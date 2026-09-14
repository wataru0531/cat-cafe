<?php

// app/Http/Requests/ContactRequest.php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {
  // このリクエストを実行してよい権限があるか確認するメソッド
  // falseの場合 → 現在のままだとお問い合わせフォームを送信しても、
  //              rules()のバリデーション処理まで進まない。
  // 今回のお問い合わせフォームは、基本的に誰でも送信できるフォームなので、trueにする。
  public function authorize(): bool {
      return true;
  }

  // ✅ バリデーションを記述
  public function rules(): array {
      return [
        'name' => ['required', 'string', 'max:255'],
        // regex → Regular Expressionの略。正規表現。
        'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
        'phone' => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
        'email' => ['required', 'email'],
        'body' => ['required', 'string', 'max:2000'],
      ];
  }

  // ✅ エラーメッセージで表示させたいない内容
  // コンタクトフォームよりもvalidation.phpよりもこちらが優先される
  public function attributes() {
    return [
      "body" => "お問い合わせ内容",
    ];
  }

  public function messages() {
    return [
      "phone.regex" => ":attributesを正しく入力してください。"
    ];
  }
}
