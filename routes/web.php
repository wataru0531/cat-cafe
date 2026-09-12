<?php

// resources/web.php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;

// Route::get('/', function () {
//     return view('index');
// });

Route::view("/", "index");



// コンタクトフォーム

//
Route::get("/admin/blogs", [AdminBlogController::class, "index"]);
Route::get("/admin/blogs/create", [AdminBlogController::class, "create"]);