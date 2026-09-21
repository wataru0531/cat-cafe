<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder2 extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   * @throws \Exception
   */
  public function run() {
    // ダミー記事生成件数
    $num = 150;

    $categories = Category::all(); // categoriesテーブルから全件取得

    // ✅ 150件分のブログデータを作る
    // array_map() → データを展開して新しい配列をつくる
    // $no → rangeから取り出した番号。最初は1、2、3、4、... 150
    //       $no をこの関数ブロックで使うために書く
    // use() → この関数外の変数を、この関数ブロックの中でも使えるようにする
    $insertData = array_map(function($no) use($num, $categories) {
        // 作成日をつくる
        $created_at = today()->subMinutes($num+$no+1)->setHours(random_int(9, 18))->setMinutes(random_int(0, 59));
        // 更新日をつくる 
        $updated_at = random_int(0, 1) === 1 ? today()->subMinutes(random_int(1, $num+$no))->setHours(random_int(9, 18))->setMinutes(random_int(0, 59)) : $created_at;
        
        // ここで1件分のデータ
        return [
          'category_id' => $categories->random()->id, // 👉 ランダムに取得
          'title' => 'ダミー記事'. $no,
          'image' => 'blogs/dummy.jpg',
          'body' => "ブログ記事のダミー本文です。\nここで改行されています\n\nここには空行が設定されています\n<p>ここはpタグで囲われています</p><script>alert('アラートが実行されたらXSS対策不備')</script>",
          'created_at' => $created_at,
          'updated_at' => $updated_at
        ];
      },
      range(1, $num) // range(1,150)で、1から150までの配列を作っている。
                      // そして、$noに1こづつ渡している
                      // array_mapの繰り返しにつかう
    );

    DB::table('blogs')->insert($insertData); // blogsテーブルに一括挿入
  }
}
