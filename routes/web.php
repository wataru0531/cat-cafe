<?php

// resources/web.php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
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
Route::get("/admin/blogs", [AdminBlogController::class, "index"])->name("admin.blogs.index");
Route::get("/admin/blogs/create", [AdminBlogController::class, "create"])->name("admin.blogs.index");

Route::post("/admin/blogs", [AdminBlogController::class, "store"])->name("admin.blogs.store");
