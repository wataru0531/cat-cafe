<?php

// ✅ ファイルライブラリ
// ユーザーでユーザー画像を登録、ねこで猫画像を登録、
// などするとそれぞれの部分で処理が重複してしまい管理が煩雑になってしまう。
// ファイルライブラリで一元管理することで、アップロードの処理や管理を一元化できる。
// → 未実装。

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {
  // Mediaモデルでは、テーブル名が自動でmediaになってしまうので明記する
  protected $table = "medias";

  protected $fillable = [
    "original_name",
    "name",
    "disk",
    "path",
    "mime_type",
    "size",
    "width",
    "height",
    "uploaded_by",
  ];

  // この画像をアップロードしたユーザーを取得できるようにする。
  // $media->uploader?->name; で画像は誰がアップロードしたのかを記録する。?でなければnullを返す。
  // belongsTo(関連づけるモデル, mediaテーブルの外部キー) ... Eloquentのリレーションメソッド。
  // 1つの画像は1人のユーザーに結びつく。逆にユーザーは多数の画像に結びついている。
  public function uploader() {
    return $this->belongsTo(User::class, 'uploaded_by');
  }
}