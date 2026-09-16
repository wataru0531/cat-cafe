<?php

// Http\Controllers\ContactController.php

// ✅ Mailpit
// http://localhost:8025/ でメールの送信内容を確認可能


namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller {
  // 
  public function index() {
    return view("contact.index");
  }

  // ✅ メール送信時
  // バリデーションは、ContactController.phpでまとめたものを使う
  public function sendMail(ContactRequest $request) {
    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      // regex → Regular Expressionの略。正規表現。
      'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
      'phone' => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
      'email' => ['required', 'email'],
      'body' => ['required', 'string', 'max:2000'],
    ]);
    // dd($validated);
    
    $validated = $request->validated(); // ContactRequest.phpでバリデーションを使う

    // Log::debug($validated['name']. 'さんよりお問い合わせがありました');
    
    // ✅ メール送信
    // to() → 宛先のメールアドレスを指定
    Mail::to("obito0531@gmail.com")->send(new ContactAdminMail($validated));
    
    return to_route('contact.complete');
  }


  // ✅ 完了ページ
  public function complete() {
    return view("contact.complete");
  }

}
