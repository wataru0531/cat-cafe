<?php

namespace App\Http\Controllers\Admin;

// AuthController

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  // 
  public function showLoginForm() {
    return view('admin.login');
  }

  // ✅　ログイン処理
  public function login(Request $request) {
    // バリデーションで検証 → 成功したらsessionに記録
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) { // email、パスが正しいかどうかを検証
        // セッションidを変更
        // → $request->session() ... このHTTPリクエストにのってるセッションデータを取得する
        //                           regenerateで再生成
        $request->session()->regenerate();

        // ✅ http://127.0.0.1:8000/admin/blogs/1 にアクセスしたい
        // → 最初はログイン画面に遷移させられる
        // → email、passwordを入力後、ログインに成功したら、Laravelがログイン前にいこうとしていたURLを覚えて
        //   いたらそのページに遷移する。セッションを利用している
        //   もし覚えていないのであれば、/admin/blogs 遷移する
        return redirect()->intended('/admin/blogs');
    }

    // ログイン情報が正しくない場合のみ実行される処理
    // 一つ前のページ(ログイン画面)にリダイレクト
    // その際にwithErrorsを使ってエラーメッセージで手動で指定する
    // → このエラーは、$errorsという形でセッションに入る
    // リダイレクト後のビュー内でold関数によって直前の入力内容を取得出来る項目をonlyInputで指定する
    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません',
    ])->onlyInput('email');
  }

  // ✅ ログアウト
  public function logout(Request $request) {
    Auth::logout(); // ログアウト。認証状態を解除

    $request->session()->invalidate(); // 現在のセッションを無効化

    // CSRFトークンを無効化して、新しいCSRFトークンを生成してセッションに保存される
    // → リダイレクト先のhtmlのcsrfに新しいcsrfトークンが入る
    $request->session()->regenerateToken();

    return redirect()->route("admin.login");
  }
}
