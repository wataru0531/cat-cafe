<?php

namespace App\Models;

// 

use Illuminate\Database\Eloquent\Model;

class Cat extends Model {
  // Blogsに多対多のリレーションをはる
  // ブログ登録画面の、登録するねこの部分で使う
  // belongsTo() → 1つのCatが１つのブログに紐づく。
  public function blog() {
    return $this->belongsToMany(Blog::class);
  }
}
