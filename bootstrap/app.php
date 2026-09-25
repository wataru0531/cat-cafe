<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

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


    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
