<?php

namespace Database\Seeders;

// ✅ 最初の管理者を登録するSeeder
// → admin/users/create では、authが効くので
//   そもそもが、DBに管理者の登録がなければcreate画面に入れないため。

// php artisan db:seed --class=AdminUserSeeder

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder {
    // firstOrCrate()
    // → DBから指定したメールアドレスのユーザーを探す。
    //   見つかった場合は、そのユーザーをそのまま返す。
    //   見つからなかった場合は、第2引数の情報で新規作成する。
    public function run(): void {
      User::firstOrCreate(
        ['email' => 'obito0531@gmail.com'],
        [
          'name' => 'wataru',
          "image" => "users/yamamoto.avif",
          "introduction" => "Seederから登録した最初の管理者",
          "password" => Hash::make("wataru1141"), // ハッシュ化して保存
        ]
      );
    }
}
