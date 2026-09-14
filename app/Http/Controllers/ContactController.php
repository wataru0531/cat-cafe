<?php

// Http\Controllers\ContactController.php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller {
  // 
  public function index() {
    return view("contact.index");
  }

  // ✅ メール送信時
  // バリデーションは、ContactController.phpでまとめたものを使う
  public function sendMail(ContactRequest $request) {
    // $validated = $request->validate([
      // 'name' => ['required', 'string', 'max:255'],
      // // regex → Regular Expressionの略。正規表現。
      // 'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
      // 'phone' => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
      // 'email' => ['required', 'email'],
      // 'body' => ['required', 'string', 'max:2000'],
    // ]);
    // dd($validated);
    
    $validated = $request->validated();

    Log::debug($validated['name']. 'さんよりお問い合わせがありました');
    return to_route('contact.complete');
  }


  // ✅ 完了ページ
  public function complete() {
    return view("contact.complete");
  }

}
