
{{-- 
✅ 500 管理者向け
  → Laravelのサーバー内部で予期しないエラーが発生し、正常に処理を完了できなかったときに表示される
  → プログラム側で何らかの問題が起きた場合

  PHPのエラー	存在しないメソッドを呼び出す
  データベースエラー	存在しないテーブルにアクセスする
  SQLエラー	SQL文の記述が間違っている
  など...
--}}

@extends("layouts.admin")

@section("content")
  <section class="flex flex-col items-center justify-center py-20">
    <h1 class="text-5xl font-bold text-gray-800 ">500(管理者用の500ページ)</h1>
    <p class="mt-6 text-xl text-gray-700 ">サーバー内でエラーが発生しました。</p>
    <p class="mt-6 text-gray-500">申し訳ありません。時間をおいてお試しください。</p>
    <a 
      href="{{ route('admin.blogs.index') }}" 
      class="mt-8 px-6 py-3 bg-indigo-500 text-white rounded hover:bg-indigo-600"
    >
      管理画面トップページに戻る
    </a>
    
  </section>

@endsection