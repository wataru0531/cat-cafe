<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// $fillable
// → 配列の値をモデルの属性にまとめて代入することを一括代入と言い、
//   @fillableは、一括代入してもよいカラムを明示する設定のこと
//   new Blog($request->validated()); この部分。
// ※ もしモデルがすべての項目を無条件に受け入れると、ユーザーが
//   本来変更できないはずの項目まで変更できてしまう危険がありために設定する

class Blog extends Model {
  // 一括代入を許可。
  // ※ imageは $blog->image = $savedImageとして個別に代入しているので一括代入の対象がい
  protected $fillable = [
    "title",
    "image",
    "body"
  ];

  // ⭐️ カテゴリーが親だということ
  //    1つのBlogは、1つのCategoryに属する
  public function category() {
    return $this->belongsTo(Category::class);
  }
}
