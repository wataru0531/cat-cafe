<?php

// resources/web.php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;

// Route::get('/', function () {
//     return view('index');
// });

Route::view("/", "index");


// ✅ コンタクトフォーム
Route::get("/contact", [ContactController::class, "index"])->name("contact");
Route::post("/contact", [ContactController::class, "sendMail"]);
Route::get("/contact/complete", [ContactController::class, "complete"])->name("contact.complete");

// ✅ 管理画面 blog
// ✅ admin/blogs の処理をまとめる
Route::prefix("/admin") // 先頭に /admin をつける。先頭のURLの共通化
  ->name("admin.") // ルート名の先頭に admin.をつける。name("admin. 〜)
  ->group(function() {

    // ✅ ログイン時のみアクセス可能ルー
    Route::middleware("auth")
      ->group(function() {
          // ブログ
          Route::get("/blogs", [AdminBlogController::class, "index"])->name("blogs.index"); // 作成
          Route::get("/blogs/create", [AdminBlogController::class, "create"])->name("blogs.create");
          Route::post("/blogs", [AdminBlogController::class, "store"])->name("blogs.store"); // 投稿、保存
          Route::get("/blogs/{blog}", [AdminBlogController::class, "edit"])->name("blogs.edit"); // 編集
          Route::put("/blogs/{blog}", [AdminBlogController::class, "update"])->name("blogs.update"); // 更新
          Route::delete("/blogs/{blog}", [AdminBlogController::class, "destroy"])->name("blogs.destroy"); // 削除

          // resource() → Laravelが7つのルートを作ってくれる
          // /blogs(index)、/blogs/create、/blogs、/blogs/{blog}、/blogs/{blog}/edit、/blogs/{blog}、/blogs/{blog}
          // Route::resource("/blogs", AdminBlogController::class)->except("show"); // showだけは作らないという意味

          // ユーザー管理
          Route::get("/users/create", [UserController::class, "create"])->name("users.create");
          Route::post("/users", [UserController::class, "store"])->name("users.store");

          // ログアウト。authが同じなので入れる
          Route::post("/logout", [AuthController::class, "logout"])->name("logout");
        });

    // ✅ 未ログイン時のみアクセス可能なルート
    Route::middleware("guest")
      ->group(function() {
        Route::get("/login", [AuthController::class, "showLoginForm"])->name("login");
        Route::post("/login", [AuthController::class, "login"]);
      });
  });


// ブログ投稿画面 管理者向け
// middleware("auth") → auth ... Laravelが認証ミドルウェアに割り当てている名前。エイリアス
//                      authを設定すると、そのルートにログイン認証のチェックが追加される。
//                      ログインしていない場合は、bootstrap/app.phpのミドルウェアが動いてリダイレクトが起きる
// Route::get("/admin/blogs", [AdminBlogController::class, "index"])->name("admin.blogs.index")->middleware("auth");
// Route::get("/admin/blogs/create", [AdminBlogController::class, "create"])->name("admin.blogs.index")->middleware("auth");
// Route::post("/admin/blogs", [AdminBlogController::class, "store"])->name("admin.blogs.store")->middleware("auth");

// // ブログ編集画面
// Route::get("/admin/blogs/{blog}", [AdminBlogController::class, "edit"])->name("admin.blogs.edit")->middleware("auth");
// // ブログ更新
// Route::put("/admin/blogs/{blog}", [AdminBlogController::class, "update"])->name("admin.blogs.update")->middleware("auth");
// // ブログ削除
// Route::delete("/admin/blogs/{blog}", [AdminBlogController::class, "destroy"])->name("admin.blogs.destroy")->middleware("auth");

// ユーザー関係
// Route::get("/admin/users/create", [UserController::class, "create"])->name("admin.users.create")->middleware("auth");
// Route::post("/admin/users/", [UserController::class, "store"])->name("admin.users.store")->middleware("auth");

// ログイン
// Route::get("/admin/login", [AuthController::class, "showLoginForm"])->name("admin.login")->middleware("guest");
// Route::post("/admin/login", [AuthController::class, "login"]);
// Route::post("/admin/logout", [AuthController::class, "logout"])->name("admin.logout")->middleware("auth");

