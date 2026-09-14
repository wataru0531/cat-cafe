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

//
Route::get("/admin/blogs", [AdminBlogController::class, "index"]);
Route::get("/admin/blogs/create", [AdminBlogController::class, "create"]);
