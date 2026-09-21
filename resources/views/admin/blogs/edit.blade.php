<!-- 
  ✅ 編集用のblade
-->

@extends('layouts.admin')

@section('content')
<section class="py-8">
  <div class="container px-4 mx-auto">
    <div class="py-4 bg-white rounded">
      <!--
        multipart/form-data
        → 画像ファイルを含むフォームデータを、ファイルとして正しく送信するため
          フォームの各データ(タイトル、ファイルなど)をパートに分けて送信可能になる。
          → テキストと画像ファイルを同じフォームから送信できる
      -->
      <form
        action="{{ route('admin.blogs.update', ['blog' => $blog->id]) }}"
        method="POST"
        enctype="multipart/form-data"
      >
        @csrf
        @method("PUT")
        <!-- 
          → POSTでリクエストが飛ぶが、実際にはPUTリクエストとして扱ってくださいとLaravelに伝える
          ⭐️ HTMLのフォームではGETかPOSTしか指定できないため。
        -->
        
        <div class="flex px-6 pb-4 border-b">
          <h3 class="text-xl font-bold">ブログ編集</h3>
          <div class="ml-auto">
            <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">更新</button>
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

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="title">タイトル</label>
            <!-- 
              ✅ タイトル 
              第2引数 → 前の入力がなかったときに表示する初期値
            -->
            <input 
              id="title" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              type="text" 
              name="title" 
              value="{{ old('title', $blog->title) }}"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="image">画像</label>
            <div class="flex items-end">
              <img 
                id="previewImage" 
                src="{{ asset('storage/' . $blog->image) }}" 
                data-noimage="{{ asset('storage/' . $blog->image) }}" 
                alt="" 
                class="rounded shadow-md w-64"
              >
              <!-- ✅ 画像ファイル -->
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
            <label class="block text-sm font-medium mb-2" for="body">本文</label>
            <!-- ✅ 本文 -->
            <textarea 
              id="body" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              name="body" 
              rows="5"
            >{{ old('body', $blog->body) }}</textarea>
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="category">カテゴリ</label>
            <div class="flex">
              <!-- 
                ✅ カテゴリー
                ⭐️ name="category_id" → Laravelに送られる時のキー
                  selectedがついているvalue → Laravelに送られる時の値
              -->
              <select
                id="category" 
                class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" 
                name="category_id"
              >
                <!-- 
                  old(category_id, $blog->category_id)
                  → 第1引数 → 入力値があればこれを使う
                    第2引数 → デフォルト値
                -->
                <option value="">選択してください</option>
                @foreach($categories as $category)
                  <option 
                    value="{{ $category->id }}"
                    @if($category->id == old("category_id", $blog->category->id)) selected @endif
                  >{{ $category->name }}</option>
                @endforeach
              </select>
              <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                </svg>
              </div>
            </div>
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2">登場するねこ</label>
            <!-- ✅ 登場するネコ -->
            <select id="js-pulldown" class="mr-6 w-full" name="" multiple>
              <option selected>Option 1</option>
              <option>Option 2</option>
              <option selected>Option 3</option>
              <option>Option 4</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
  // ねこちゃんたち追加
  $('#js-pulldown').select2();

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