<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
      web: __DIR__.'/../routes/web.php',
      commands: __DIR__.'/../routes/console.php',
      health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware): void {
      // ✅ ミドルウェアの設定
      // web.phpで追加の設定を行う
      // → Route::get("/admin/login", [AuthController::class, "showLoginForm"])->name("admin.login")->middleware("guest");

      // 未ログインユーザーをどこにリダイレクトするか
      // → 未ログイン時のリダイレクト先を指定する従来の設定
      // $middleware->redirectTo(fn() => route("admin.login"));

      // ✅ 未ログイン時の挙動。authに弾かれた場合どこに遷移させるか
      $middleware->redirectGuestsTo(fn() => route("admin.login"));

      // ✅ ログイン済み時の挙動。guestに弾かれた場合どこに遷移させるか
      // → ログイン済みなのでログインページに入れるのはおかしい
      $middleware->redirectUsersTo(fn() => route("admin.blogs.index"));

      // ✅ 管理者でなければ403エラーを返す。
      $middleware->alias([
        "admin" => EnsureUserIsAdmin::class,
      ]);

  })
  ->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->shouldRenderJsonWhen(
        fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
    );

    // ✅ 管理画面と一般画面とでエラーページを出し分ける
    // $exceptions->render(function (Throwable $e, Request $request) {

    //     // ① HTTPステータスコードを取得
    //     $status = $e instanceof HttpExceptionInterface
    //         ? $e->getStatusCode()
    //         : 500;

    //     // ② 対象のエラー以外はLaravel標準の処理に任せる
    //     if (!in_array($status, [403, 404, 500])) {
    //       return null;
    //     }

    //     // ③ 管理者向けURLかどうかを判定
    //     $isAdmin = $request->is('admin', 'admin/*');

    //     // ④ 表示するBladeファイルを決定
    //     $view = $isAdmin
    //         ? "errors.admin.{$status}"
    //         : "errors.{$status}";

    //     // ⑤ エラーページを返す
    //     return response()->view($view, [], $status);
    // });



  })->create();


  