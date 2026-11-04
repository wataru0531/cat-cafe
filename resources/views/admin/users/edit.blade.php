
<!-- 
  edit.blade.php
  ユーザー編集画面

  ✅ TODO 
  ・パスワードの部分を、クリックしたらtype="password"からtype="text"に変更
    → createページも
-->

@extends('layouts.admin')

@section('content')

<section class="py-8">
  <div class="container px-4 mx-auto">
    <div class="py-4 bg-white rounded">
      <form 
        action="{{ route('admin.users.update', ['userId' => $user->id]) }}" 
        method="POST" 
        enctype="multipart/form-data"
      >
        @csrf
        @method("PUT")

        <div class="flex px-6 pb-4 border-b">
          <h3 class="text-xl font-bold">ユーザ編集画面</h3>
          <div class="ml-auto">
            <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">編集</button>
          </div>
        </div>

        <div class="pt-4 px-6">
          <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->
          @if($errors->any())
            <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
              <ul>
                @foreach($errors->all() as $error)
                  <li class="text-red-400">{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="name">名前</label>
            <!-- 
              ✅名前 
              第2引数 → 前の入力がなかったときに表示する初期値
            -->
            <input 
              id="name" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              type="text" 
              name="name" 
              value="{{ old('name', $user->name) }}"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
            <input 
              id="email" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              type="email" 
              name="email" 
              value="{{ old('email', $user->email) }}"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="password">パスワード(更新)</label>
            {{-- 
              パスワードはキャッシュに保持しない 
              既存のパスワードは表示しない。
              初期値は空欄にする。
              変更しない場合は空欄のまま送信する。
            --}}
            <input 
              id="password" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              type="password" 
              name="password"
            >
          </div>

          {{-- ⭐️ 削除する --}}
          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="password_confirmation">パスワード(確認)</label>
            <input 
              id="password_confirmation" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              type="password" 
              name="password_confirmation"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="image">画像</label>
            <div class="flex items-end">
              <img 
                id="previewImage" 
                src="{{ asset('storage/' . $user->image) }}" 
                data-noimage="/images/admin/noimage.jpg" 
                alt="" 
                class="rounded-full shadow-md w-32"
              >
              <input 
                id="image" 
                class="block w-full px-4 py-3 mb-2" 
                type="file" 
                accept='image/*' 
                name="image"
              >
            </div>
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="introduction">自己紹介文</label>
            <textarea 
              id="introduction" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              name="introduction" 
              rows="2"
            >{{ old('introduction', $user->introduction) }}</textarea>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
  // 画像プレビュー
  document.getElementById('image').addEventListener('change', e => {
    const previewImageNode = document.getElementById('previewImage')
    const fileReader = new FileReader()
    fileReader.onload = () => previewImageNode.src = fileReader.result
    if (e.target.files.length > 0) {
        fileReader.readAsDataURL(e.target.files[0])
    } else {
        previewImageNode.src = previewImageNode.dataset.noimage
    }
  })
</script>
@endsection