<?php

// ✅ 一般ユーザー向け画面
// ☑️ contact indexページ
// ☑️ contact completeページ
// blogs indexページ
// blogs detailsページ
// cats indexページ
// cats detailsページ → viewファイルなし
// ↓ 下記は教材にはない
// category 一覧ページ → ページにするか、どこかにパーツとしてリンクさせるか
//                     カテゴリーをクリックするとそのカテゴリーに属するブログのみ一覧表示など
// category 詳細ページ

// 404エラ- error/404.blade.php
// 500エラー error/500.blade.php
// 利用規約ページ terms.blade.php
// プライバシーポリシー privacy.blade.php

// サイドバー → リンクを埋める
// → ユーザー管理 /admin/users/index.blade.php
//   ☑️ ブログ管理 
//   ☑️ お問い合わせ管理
//   ファイルライブラリ → アップロード済みファイルを一覧・管理する
//   設定
//   ☑️ ログアウト処理


// ✅ 管理画面
// ☑️ blogs indexページ
// ☑️ blogs createページ
// ☑️ blogs editページ
// ☑️ contacts indexページ
// ☑️ contacts 詳細ページ
// ☑️ users createページ
// users 一覧ページ → viewファイルなし
// users detailsページ → viewファイルなし
// users 編集ページ
// category 作成ページ admin/cats/create.blade.php
// category 編集ページ admin/cats/edit.blade.php

// ダッシュボード admin/dashboard.blade.php
// → ブログ投稿数、登録ユーザー数、未対応のお問い合わせ数、最新のブログ投稿、最新のお問い合わせ
//   などを表示


// ✅ 認証関係
// ☑️ ログインページ

// ✅ すべてのことに気をつけること
// ページネーション	ブログやユーザーの一覧を分割
// 検索機能	ブログ・ユーザーの検索
// 絞り込み	カテゴリーやステータスで絞り込む
// ソート	投稿日・更新日などで並び替え
// バリデーション	入力値のチェック
// 認可	管理者以外が管理画面に入れないようにする
// CSRF対策	不正なリクエストへの対策
// 論理削除	データを残したまま削除扱いにする
// 画像アップロード	ブログやユーザー画像の登録
// フラッシュメッセージ	登録・更新・削除の成功通知


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminUserController;
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
Route::get("/admin/users", [AdminUserController::class, "index"])->name("admin.users.index")->middleware("auth");
Route::get("/admin/users/create", [AdminUserController::class, "create"])->name("admin.users.create")->middleware("auth");
Route::post("/admin/users/", [AdminUserController::class, "store"])->name("admin.users.store")->middleware("auth");

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





