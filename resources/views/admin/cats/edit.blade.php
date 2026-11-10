<!-- 
  ✅ カテゴリー編集ページ
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
        action="{{ route('admin.categories.update', ['categoryId' => $category->id]) }}"
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
          <h3 class="text-xl font-bold">カテゴリー編集</h3>
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
            <label class="block text-sm font-medium mb-2" for="name">カテゴリー名</label>           
            <input 
              id="name" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" 
              type="text" 
              name="name" 
              value="{{ old("name", $category->name) }}"
            >
          </div>

          
        </div>
      </form>
    </div>
  </div>

</section>

<script>
  // ねこちゃんたち追加
  // $('#js-pulldown').select2();

  // // 画像プレビュー
  // document.getElementById('image').addEventListener('change', e => {
  //   const previewImageNode = document.getElementById('previewImage')
  //   const fileReader = new FileReader()
  //   fileReader.onload = () => previewImageNode.src = fileReader.result
    
  //   if (e.target.files.length > 0) {
  //     fileReader.readAsDataURL(e.target.files[0])
  //   } else {
  //     previewImageNode.src = previewImageNode.dataset.noimage
  //   }
  // })
</script>
@endsection