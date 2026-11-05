<?php

namespace App\Http\Middleware;

// ✅ 管理者でなければ、そのページにアクセスできないようにするミドルウェア
// app.phpでエイリアス登録
// web.phpでルートにadminで登録

// ⭐️ TODO
// 403ページにもヘッダーなどのレイアウトページを用意する

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin {
  public function handle(Request $request, Closure $next): Response {
    // 管理者でなければ,403エラーを返す。
    if($request->user()->role !== "admin") {
      abort(403, "管理者以外はこのページにアクセスできません。");
    }

    return $next($request);
  }
}
