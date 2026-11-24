<?php
// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
// headタグの中を動的にする

////////////////////////////////
// ✅ 一般ユーザー向け画面
///////////////////////////////
// ✅ ブログ
// blogs/index
// blogs/blogId

// ✅ 猫
// cats/index
// cats/catId

// ✅ カテゴリー
// → ページにするか、どこかにパーツとしてリンクさせるか
//   カテゴリーをクリックするとそのカテゴリーに属するブログのみ一覧表示など
// categories/index
// categories/categoryId

// ✅ エラーページ関連
// ☑️ 403エラー errors/403.blade.php。アクセス禁止のページ
// ☑️ 404エラ- errors/404.blade.php  ページが存在しない場合
// ☑️ 500エラー errors/500.blade.php サーバー内エラー

// ✅ お問い合わせ一覧
// ☑️ contact indexページ
// ☑️ contact completeページ

// ✅ サイドバー → リンクを埋める
// ☑️ユーザー管理 /admin/users/index.blade.php
// ☑️ ブログ管理 
// ☑️ お問い合わせ管理
// ☑️ ファイルライブラリ → アップロード済みファイルを一覧・管理する
// ☑️ ログアウト処理
// ☑️ カテゴリー
// ☑️ 登録してる猫
// ❌ 設定

// ❌ 利用規約ページ 
// terms.blade.php

// ❌ プライバシーポリシー
// privacy.blade.php


// ✅ 付けたい機能関係
// ブログ検索機能
// → ブログタイトル、ブログ本文、猫の名前


/////////////////////////////
// ✅ 管理画面
/////////////////////////////
// ✅ ブログ
// ☑️ blogs indexページ
// ☑️ blogs createページ
// ☑️ blogs editページ

// ✅ お問い合わせ
// ☑️ contacts indexページ
// ☑️ contacts 詳細ページ

// ✅ 登録ユーザー
// ☑️ users createページ
// ☑️ users 一覧ページ
// users detailsページ → viewファイルまだ
// ☑️ users 編集ページ
// ☑️ users 削除機能をつける。+ 確認モーダル

// ✅ カテゴリー
// ☑️ category 一覧ページ admin/categories/index.blade.php
// ☑️ category 作成ページ admin/categories/create.blade.php
// ☑️ category 編集ページ admin/categories/edit.blade.php
// ☑️  → category 削除機能も付帯。モーダル
//            → ブログと紐づいているので注意

// ✅ 登録中のねこ
// ☑️ cats 一覧ページ admin/cats/index.blade.php
// ☑️ cats作成ページ admin/cats/create.blade.php
//              → post。admin/cats
// ☑️ cats編集ページ admin/cats/edit.blade.php
//              → put。admin/cats/{catsId}
// ☑️ cats削除機能 → delete。admin/cats/{catsId}
//           　　※ blogで使われているcatは削除できない

// ✅ ファイルライブラリページ
// ☑️ admin/media/index.blade.php ... 一覧
// ☑️ admin/media/create ... 作成
// ☑️ post admin/media ... upload
// ☑️ delete admin/media/{media} ... 削除

// → 画像の一覧のレイアウトを作る
//   画像のプレビュ-
//   ファイル名
//   アップロード日時
//   画像の削除
//   画像の検索

// ✅ 付けたい機能
// ブログ検索
// ブログ絞り込み検索
// ブログソート → 投稿日、更新日順
// ユーザー検索、ユーザー絞り込み
// 

// ❌ 個人制作で追加する。
// ❌ ダッシュボード admin/dashboard.blade.php
// → ブログ投稿数、
//   登録ユーザー数、
//   未対応のお問い合わせ数、
//   最新のブログ投稿、
//   最新のお問い合わせ

// ❌ 設定画面
// → ❓TODO 項目はどうする。

// ⭐️ TODO
// ユーザー管理だけではなくて、adminのユーザー以外でも入れるページなどを確認する


//////////////////////////////
// ✅ 認証関係
/////////////////////////////
// ☑️ ログインページ
// パスワード再設定	パスワードを忘れた場合
// ログイン失敗制限	ログイン試行回数の制限

//////////////////////////////////
// ✅ すべてのことに気をつけること
//////////////////////////////////
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
// フラッシュメッセージ	登録・更新・削除の失敗



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCatController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminMediaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;

///////////////////////////////////////////////////////////////
// ✅ 一般ユーザー向けのルート
//////////////////////////////////////////////////////////////
// Route::get('/', function () {
//     return view('index');
// });

// Route::view() → 直接bladeファイルを呼び出す。
// Route::view("/", "index")->name("blog.index");
Route::get("/", [HomeController::class, "index"])->name("home.index");

// ✅ ブログ
Route::get("/blogs", [BlogController::class, "index"])->name("blogs.index");
Route::get("/blogs/{blogId}", [BlogController::class, "show"])->name("blogs.show");
// ✅ カテゴリ一覧


// コンタクトフォーム
Route::get("/contact", [ContactController::class, "index"])->name("contact.index");
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
Route::get("/admin/blogs/{blog}", [AdminBlogController::class, "edit"])->name("admin.blogs.edit")->middleware("auth");
Route::put("/admin/blogs/{blog}", [AdminBlogController::class, "update"])->name("admin.blogs.update")->middleware("auth");
Route::delete("/admin/blogs/{blog}", [AdminBlogController::class, "destroy"])->name("admin.blogs.destroy")->middleware("auth");

// ✅ ユーザー関係
// 管理者(admin)ではないと閲覧できない。
Route::middleware(["auth", "admin"])->group(function() {
  Route::get("/admin/users", [AdminUserController::class, "index"])->name("admin.users.index")->middleware("auth");
  Route::get("/admin/users/create", [AdminUserController::class, "create"])->name("admin.users.create")->middleware("auth");
  Route::post("/admin/users/", [AdminUserController::class, "store"])->name("admin.users.store")->middleware("auth");
  Route::get("/admin/users/{userId}", [AdminUserController::class, "edit"])->name("admin.users.edit")->middleware("auth");
  Route::put('/admin/users/{userId}', [AdminUserController::class, "update"])->name("admin.users.update")->middleware("auth");
  Route::delete("/admin/users/{userId}", [AdminUserController::class, "destroy"])->name("admin.users.destroy")->middleware("auth");
});

// ✅ カテゴリー関連
Route::get("/admin/categories", [AdminCategoryController::class, "index"])->name("admin.categories.index")->middleware("auth");
Route::get("/admin/categories/create", [AdminCategoryController::class, "create"])->name("admin.categories.create")->middleware("auth");
Route::post("/admin/categories", [AdminCategoryController::class, "store"])->name("admin.categories.store")->middleware("auth");
Route::get("/admin/categories/{categoryId}", [AdminCategoryController::class, "edit"])->name("admin.categories.edit")->middleware("auth");
Route::put("/admin/categories/{categoryId}", [AdminCategoryController::class, "update"])->name("admin.categories.update")->middleware("auth");
Route::delete("/admin/categories/{categoryId}", [AdminCategoryController::class, "destroy"])->name("admin.categories.destroy")->middleware("auth");

// ✅ 猫一覧
Route::get('/admin/cats', [AdminCatController::class, 'index'])->name('admin.cats.index')->middleware("auth");
Route::get("/admin/cats/create", [AdminCatController::class, "create"])->name("admin.cats.create")->middleware("auth");
Route::post("/admin/cats", [AdminCatController::class, "store"])->name("admin.cats.store")->middleware("auth");
Route::get("/admin/cats/{catId}", [AdminCatController::class, "edit"])->name("admin.cats.edit")->middleware("auth");
Route::put("/admin/cats/{catId}", [AdminCatController::class, "update"])->name("admin.cats.update")->middleware("auth");
Route::delete("/admin/cats/{catId}", [AdminCatController::class, "destroy"])->Name("admin.cats.destroy")->middleware("auth");

// ✅ 管理者向けお問い合わせ画面
// お問い合わせの一覧
Route::get("/admin/contacts", [AdminContactController::class, "index"])->name("admin.contacts.index")->middleware("auth");
Route::delete("/admin/contacts/{contact}", [AdminContactController::class, "destroy"])->name("admin.contacts.destroy")->middleware("auth");
Route::patch("/admin/contacts/{contact}/toggle-completed", [AdminContactController::class, "toggleCompleted"])->name("admin.contacts.toggleCompleted")->middleware("auth");
// → どの処理にアクセスしているかがわかりやすいので、toggle-completeをつける
// 詳細
Route::get("/admin/contacts/{contactId}", [AdminContactController::class, "show"])->name("admin.contacts.show")->middleware("auth");
// 更新(対応済みかどうか、管理者のコメント)
Route::patch(
  "/admin/contacts/{contactId}/admin-details",
  [AdminContactController::class, "updateAdminDetails"],
)->name("admin.contacts.updateAdminDetails")->middleware("auth");

// ✅ ファイルライブラリ
Route::get("/admin/medias", [AdminMediaController::class, "index"])->name("admin.medias.index")->middleware("auth");
Route::get("/admin/medias/create", [AdminMediaController::class, "create"])->name("admin.medias.create")->middleware("auth");
Route::post("/admin/medias", [AdminMediaController::class, "store"])->name("admin.medias.store")->middleware("auth");
Route::get("/admin/medias/{mediaId}", [AdminMediaController::class, "edit"])->name("admin.medias.edit")->middleware("auth");
Route::put("/admin/medias/{mediaId}", [AdminMediaController::class, "update"])->name("admin.medias.update")->middleware("auth");
Route::delete("/admin/medias/{mediaId}", [AdminMediaController::class, "destroy"])->name("admin.medias.destroy")->middleware("auth");

// ✅ 認証関係
Route::get("/admin/login", [AuthController::class, "showLoginForm"])->name("admin.login")->middleware("guest");
Route::post("/admin/login", [AuthController::class, "login"])->middleware("guest");
Route::post("/admin/logout", [AuthController::class, "logout"])->name("admin.logout")->middleware("auth");





