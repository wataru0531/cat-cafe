
{{-- 

✅ 403ページ 一般ユーザー向け
  → 権限が与えられていないページにアクセスした場合に表示される。

  ・一般ユーザーが管理者専用ページにアクセス	403
  ・ログインユーザーに編集権限がない	403
  ・ログインユーザーに削除権限がない	403

  ⭐️ 一般ユーザー向け画面で、403を返す場合
  ・他人の投稿を編集 → 自分以外のユーザーが作成したブログを編集しようとした
  ・他人の投稿を削除 → 自分以外のユーザーの投稿を削除しようとした
  ・非公開ページへのアクセス → 閲覧権限のないページにアクセスした
  ・ログインユーザー限定の操作 → ログインしていない状態で、権限が必要な操作をした

--}}

@extends("layouts.admin")

@section("content")
  <section class="flex flex-col items-center justify-center py-20">
    <h1 class="text-5xl font-bold text-gray-800 ">403(一般ユーザー用の403)</h1>
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