<?php

// ✅ ブログ。一般ユーザー向け

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;


class BlogController extends Controller {
  // ✅ 一覧
  public function index() {
    // latest() ... 降順に並べる。
    // $blogs = Blog::latest()->get();
    // simplePaginate(6) ... 1ページあたり6件取得するようにLaravelが処理する。
    
    // simplePaginate ... 前へ・次へ
    // $blogs = Blog::with(['category', 'user'])->latest()->simplePaginate('6');
    
    // paginate ... ページ番号・前へ・次へ
    $blogs = Blog::with(["category", "user"])->latest()->paginate(6);

    return view("blogs.index", [
      "blogs" => $blogs,
    ]);
  }

  // ✅ 詳細ページ
  public function show(string $blogId) {
    // dd($blogId);
    // 紐づいているカテゴリー、ユーザーのデータも取得する。
    $blog = Blog::with(["category", "user"])->findOrFail($blogId);

    $otherBlogs = collect(); // Laravelのコレクション。複数のデータをまとめて扱う入れ物。

    if($blog->user) {
      // $blog->user ... この記事を書いたユーザーを取得
      // $blog-user->blogs() ... ユーザーに紐づいているブログ全てを取得
      $otherBlogs = $blog->user->blogs()
      ->with(["category"])
      ->where("id", "!=", $blog->id) // 現在表示しているブログ以外
      ->latest() // 最新順
      ->take(4)  // 取得する件数を最大3件
      ->get();
    }

    return view("blogs.show", [
      "blog" => $blog,
      "otherBlogs" => $otherBlogs,
    ]);
  }

  // ✅ 各ユーザーの一覧ページ
  public function userBlogs(string $userId) {
    $user = User::findOrFail($userId);

    // with() ... 紐づくcategoryもあらかじめ取得しておく。
    //            これがなければ、view側でDBにカテゴリーを撮りに行く
    $blogs = $user->blogs()->with("category")->latest()->paginate(6);
    // $blogs = $user->blogs()->latest()->paginate(6);

    return view("blogs.user", [
      "user" => $user,
      "blogs" => $blogs,
    ]);


  }
}