
{{-- 

✅ 404 管理者向け

--}}

@extends("layouts.admin")

@section("content")
  <section class="flex flex-col items-center justify-center py-20">
    <h1 class="text-5xl font-bold text-gray-800 ">404</h1>
    <p class="mt-6 text-gray-500">管理画面のページが見つかりませんでした。</p>
    <a 
      href="{{ route('admin.blogs.index') }}" 
      class="mt-8 px-6 py-3 bg-indigo-500 text-white rounded hover:bg-indigo-600"
    >
      管理画面トップページに戻る
    </a>
  </section>

@endsection