<?php

// ⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから
// ⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから
// トップページ
// ブログ一覧ページ
// ブログ詳細ページ
// お問い合わせ一覧ページ 
// お問い合わせ詳細ページ ⭐️ ここから

// ユーザー一覧ページ
// ✅ ユーザー作成ページ

// 猫の一覧ページ
// 猫の詳細ページ

// resources/web.php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;


// ✅ 一般ユーザー向けのルート
// Route::get('/', function () {
//     return view('index');
// });

Route::view("/", "index");


// コンタクトフォーム
Route::get("/contact", [ContactController::class, "index"])->name("contact");
Route::post("/contact", [ContactController::class, "sendMail"]);
Route::get("/contact/complete", [ContactController::class, "complete"])->name("contact.complete");


//////////////////////////////////////////////////////////////////
// ✅ 管理者向けのルート
//////////////////////////////////////////////////////////////////
// ブログ投稿画面 管理者向け
// middleware("auth") → auth ... Laravelが認証ミドルウェアに割り当てている名前。エイリアス
//                      authを設定すると、そのルートにログイン認証のチェックが追加される。
//                      ログインしていない場合は、bootstrap/app.phpのミドルウェアが動いてリダイレクトが起きる
Route::get("/admin/blogs", [AdminBlogController::class, "index"])->name("admin.blogs.index")->middleware("auth");
Route::get("/admin/blogs/create", [AdminBlogController::class, "create"])->name("admin.blogs.create")->middleware("auth");
Route::post("/admin/blogs", [AdminBlogController::class, "store"])->name("admin.blogs.store")->middleware("auth");

// ブログ編集画面
Route::get("/admin/blogs/{blog}", [AdminBlogController::class, "edit"])->name("admin.blogs.edit")->middleware("auth");
// ブログ更新
Route::put("/admin/blogs/{blog}", [AdminBlogController::class, "update"])->name("admin.blogs.update")->middleware("auth");
// ブログ削除
Route::delete("/admin/blogs/{blog}", [AdminBlogController::class, "destroy"])->name("admin.blogs.destroy")->middleware("auth");

// ユーザー関係
Route::get("/admin/users/create", [UserController::class, "create"])->name("admin.users.create")->middleware("auth");
Route::post("/admin/users/", [UserController::class, "store"])->name("admin.users.store")->middleware("auth");

// 管理者向けお問い合わせ画面
// お問い合わせの一覧
Route::get("/admin/contacts", [AdminContactController::class, "index"])->name("admin.contacts.index")->middleware("auth");
Route::delete("/admin/contacts/{contact}", [AdminContactController::class, "destroy"])->name("admin.contacts.destroy");
Route::patch("/admin/contacts/{contact}/toggle-completed", [AdminContactController::class, "toggleCompleted"])->name("admin.contacts.toggleCompleted");
// → どの処理にアクセスしているかがわかりやすいので、toggle-completeをつける

// 詳細
Route::get("/admin/contacts/{contactId}", [AdminContactController::class, "show"])->name("admin.contacts.show")->middleware("auth");
// 更新(対応済みかどうか、管理者のコメント)
Route::patch(
  "/admin/contacts/{contactId}/admin-details",
  [AdminContactController::class, "updateAdminDetails"],
)->name("admin.contacts.updateAdminDetails")->middleware("auth");


// 認証関係
Route::get("/admin/login", [AuthController::class, "showLoginForm"])->name("admin.login")->middleware("guest");
Route::post("/admin/login", [AuthController::class, "login"])->middleware("guest");
Route::post("/admin/logout", [AuthController::class, "logout"])->name("admin.logout")->middleware("auth");





