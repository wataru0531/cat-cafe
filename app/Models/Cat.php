<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Cat extends Model {
  protected $fillable = [
    "name",
    "breed",
    "gender",
    "date_of_birth",
    "image",
    "introduction",
  ];

  // Blogsに多対多のリレーションをはる
  // belongsTo() → 1つのCatが１つのブログに紐づく。
  public function blogs() {
    return $this->belongsToMany(
      Blog::class,  // 関連するモデル
      "blog_cat", // 中間テーブル名
      "cat_id",     // このCatモデル側の外部キー
      "blog_id"     // Blogモデル側の外部キー
    )->withTimestamps();
  }

  // 🌾 Blogテーブルにも同様にリレーションをはることで、関連データを取得できる
  // 1の猫が登場するブログ一覧
  // $cat = Cat::find(1);
  // $blogs = $cat->blogs;
  // 4のブログに登場する猫一覧
  // $blog = Blog::find(4);
  // $cats = $blog->cats; 

  // ✅　猫の年齢を生年月日から取得する
  // viewで、$cat->age で年齢を取得できる。
  public function getAgeAttribute() {
    return Carbon::parse($this->date_of_birth)->age;
  }
}
