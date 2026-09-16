<?php

// app/Http/Requests/ContactRequest.php

// ⭐️ ContactRequest.phpは、お問い合わせ専用のバリデーション設定
// ⭐️ validation.php → Laravel全体で使う共通のバリデーション、メッセージ


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

  // ✅ 項目名をどう表示するかを変更する処理
  public function attributes() {
    return [
      "body" => "お問い合わせ内容", // textareaの、「本文」から変更する
    ];
  }

  // ⭐️ バリデーションに失敗したときに表示する「エラーメッセージ」を自分で指定する
  public function messages() {
    return [
      // phone に対して regex のチェックに失敗した場合 → validation.phpを参照する
      "phone.regex" => ":attributeを正しく入力してください。"
    ];
  }
}
