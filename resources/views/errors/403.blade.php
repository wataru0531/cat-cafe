
{{-- 

✅ 403ページ
  Laravelは、HTTPステータスコードに対応したBladeファイルを自動的に探す。
  ステータスコード	Bladeファイル
  403	errors/403.blade.php
  404	errors/404.blade.php
  500	errors/500.blade.php

--}}

@extends("layouts.admin")

@section("content")
  <section class="flex flex-col items-center justify-center py-20">
    <h1 class="text-5xl font-bold text-gray-800 ">403</h1>
    <p class="mt-6 text-xl text-gray-700 ">アクセスが禁止されています。</p>
    <p class="mt-6 text-gray-500">管理者以外はこのページにアクセスできません。</p>
    <a 
      href="{{ route('admin.blogs.index') }}" 
      class="mt-8 px-6 py-3 bg-indigo-500 text-white rounded hover:bg-indigo-600"
    >
      管理画面トップページに戻る
    </a>
    
  </section>

@endsection