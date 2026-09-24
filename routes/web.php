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


// コンタクトフォーム
Route::get("/contact", [ContactController::class, "index"])->name("contact");
Route::post("/contact", [ContactController::class, "sendMail"]);
Route::get("/contact/complete", [ContactController::class, "complete"])->name("contact.complete");

// ブログ投稿画面 管理者向け
// middleware("auth") → auth ... Laravelが認証ミドルウェアに割り当てている名前。エイリアス
//                      authを設定すると、そのルートにログイン認証のチェックが追加される。
//                      ログインしていない場合は、bootstrap/app.phpのミドルウェアが動いてリダイレクトが起きる
Route::get("/admin/blogs", [AdminBlogController::class, "index"])->name("admin.blogs.index")->middleware("auth");
Route::get("/admin/blogs/create", [AdminBlogController::class, "create"])->name("admin.blogs.index")->middleware("auth");
Route::post("/admin/blogs", [AdminBlogController::class, "store"])->name("admin.blogs.store");

// ブログ編集画面
Route::get("/admin/blogs/{blog}", [AdminBlogController::class, "edit"])->name("admin.blogs.edit");
// ブログ更新
Route::put("/admin/blogs/{blog}", [AdminBlogController::class, "update"])->name("admin.blogs.update");
// ブログ削除
Route::delete("/admin/blogs/{blog}", [AdminBlogController::class, "destroy"])->name("admin.blogs.destroy");

// ユーザー関係
Route::get("/admin/users/create", [UserController::class, "create"])->name("admin.users.create");
Route::post("/admin/users/", [UserController::class, "store"])->name("admin.users.store");

// ログイン
Route::get("/admin/login", [AuthController::class, "showLoginForm"])->name("admin.login");
Route::post("/admin/login", [AuthController::class, "login"]);
Route::post("/admin/logout", [AuthController::class, "logout"])->name("admin.logout");