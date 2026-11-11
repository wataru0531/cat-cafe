<?php
////////////////////////////////
// ✅ 一般ユーザー向け画面
///////////////////////////////
// ☑️ contact indexページ
// ☑️ contact completeページ
// blogs indexページ
// blogs detailsページ
// cats indexページ
// cats detailsページ → viewファイルなし
// ↓ 下記は教材にはない
// category 一覧ページ → ページにするか、どこかにパーツとしてリンクさせるか
//                     カテゴリーをクリックするとそのカテゴリーに属するブログのみ一覧表示など


// ☑️ 403エラー errors/403.blade.php。アクセス禁止のページ
// 404エラ- errors/404.blade.php  ページが存在しない場合
// 500エラー errors/500.blade.php サーバー内エラー
// 利用規約ページ terms.blade.php
// プライバシーポリシー privacy.blade.php

// ✅ サイドバー → リンクを埋める
// → ユーザー管理 /admin/users/index.blade.php
//   ☑️ ブログ管理 
//   ☑️ お問い合わせ管理
//   ファイルライブラリ → アップロード済みファイルを一覧・管理する
//   設定
//   ☑️ ログアウト処理
// ※ カテゴリー、登録してる猫、ファイルライブラリなどの項目を追加

/////////////////////////////
// ✅ 管理画面
/////////////////////////////
// ☑️ blogs indexページ
// ☑️ blogs createページ
// ☑️ blogs editページ
// ☑️ contacts indexページ
// ☑️ contacts 詳細ページ
// ☑️ users createページ
// ☑️ users 一覧ページ → viewファイルまだ
// ☑️ users detailsページ → viewファイルまだ
// ☑️ users 編集ページ
// ☑️ users 削除機能をつける。+ 確認モーダル
// ☑️ category 一覧ページ admin/categories/index.blade.php
// ☑️ category 作成ページ admin/categories/create.blade.php
// ☑️ category 編集ページ admin/categories/edit.blade.php
// ☑️  → category 削除機能も付帯。モーダル
//            → ブログと紐づいているので注意

// ⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから
// ⭐️これから⭐️これから⭐️これから⭐️これから⭐️これから
// cats関連のbladeをさくせい
// cats 一覧ページ admin/cats/index.blade.php
// cats作成ページ admin/cats/create.blade.php
//              → post。admin/cats
// cats編集ページ admin/cats/edit.blade.php
//              → put。admin/cats/{catsId}
// cats削除機能 → delete。admin/cats/{catsId}
//           　　※ blogで使われているcatは削除できない





// 設定画面

// ファイルライブラリページ
// → アップロード済み画像の一覧
//   画像のプレビュ-
//   ファイル名
//   アップロード日時
//   画像の削除
//   画像の検索


// ダッシュボード admin/dashboard.blade.php
// → ブログ投稿数、
//   登録ユーザー数、
//   未対応のお問い合わせ数、
//   最新のブログ投稿、
//   最新のお問い合わせ


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
Route::post("/admin/cats/{catId}", [AdminCatController::class, "store"])->name("admin.cats.store")->middleware("auth");
Route::get("/admin/cats/{catId}", [AdminCatController::class, "edit"])->name("admin.cats.edit")->middleware("auth");
Route::put("/admin/cats/{catsId}", [AdminCatController::class, "update"])->name("admin.cats.update")->middleware("auth");
Route::delete("/admin/cats/{catsId}", [AdminCatController::class, "destroy"])->Name("admin.cats.destroy")->middleware("auth");


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





