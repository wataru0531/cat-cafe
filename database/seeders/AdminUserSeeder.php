<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
      User::firstOrCreate(
        ['email' => 'obito0531@gmail.com'],
        [
          'name' => 'wataru',
          "image" => "XCxq5AFELY0oFs7LrRBZCj4L9jywdjYfgNfDDuze.jpg",
          "introduction" => "管理者のアカウント",
          'password' => 'wataru1141',
        ]
      );
    }
}
