<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 
#[Fillable([
  'name', 
  'email', 
  'password',
  "image",
  "introduction",
  "role",
  ])
]

#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable {
  use HasFactory, Notifiable;

  protected function casts(): array {
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
  }

  // アップロードした画像を取得する
  // $user->medias; で画像を取得
  // 1人のユーザーは多数の画像を持つ。逆に、画像はユーザー1人に結びつく。
  // → 多 対 １
  public function medias() {
    return $this->hasMany(Media::class, "uploaded_by");
  }


}
