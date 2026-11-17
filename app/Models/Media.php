<?php

// ✅ ファイルライブラリ

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {
  protected $fillable = [
    "original_name",
    "disk",
    "path",
    "mime_type",
    "size",
    "width",
    "height",
    "uploaded_by",
  ];

  // ユーザーとのリレーションをはる
  // $media->uploader?->name; でアップロードしたユーザーの名前を取得できる
  public function uploader() {
    return $this->belongsTo(User::class, 'uploaded_by');
  }

}
