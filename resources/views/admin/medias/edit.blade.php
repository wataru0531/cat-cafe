<!-- 
  ✅ メディア編集ページ

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
        action="{{ route('admin.medias.update', ['mediaId' => $media->id]) }}"
        method="POST"
      >
        @csrf
        @method("PUT")
        <!-- 
          → POSTでリクエストが飛ぶが、実際にはPUTリクエストとして扱ってくださいとLaravelに伝える
          ⭐️ HTMLのフォームではGETかPOSTしか指定できないため。
        -->
        
        <div class="flex px-6 pb-4 border-b">
          <h3 class="text-xl font-bold">メディアのデータ編集</h3>
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

          {{-- 画像名 --}}
          <div class="mb-6">
            <label for="name" class="block text-sm font-medium mb-2">名前</label>
            <input
              id="name"
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none"
              type="text"
              placeholder="画像に名前をつけてください。"
              name="name"
              value="{{ old('name', $media->name) }}"
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

  // ✅ 画像プレビュー
  // image ... inputタブ
  // previewImage ... imgタグ
  document.getElementById("image").addEventListener("change", (e) => {
    const previewImage = document.getElementById("previewImage");
    const fileReader = new FileReader(); // 選択したファイルをロードする機能を持つ

    // ファイルを読み込んだら発火、previewImageに画像を設定
    // fileReader.result ... ロードしたデータを格納している
    fileReader.onload = () => previewImage.src = fileReader.result; 

    if(e.target.files.length > 0) {
      // readAsDataURL ... 画像データをURL形式に変換してロード。
      //                   → これが終われば、fileReader.resultで画像を取得できる
      //                   → 形式 ... data:image/png;base64,iVBORw0KGgo...
      //                   → ※ storageフォルダに入るファイル名は関係ない。
      // console.log(e.target.files[0]); // File {name: '11.avif', lastModified: 1732360031464, lastModifiedDate: Sat Nov 23 2024 20:07:11 GMT+0900 (日本標準時), webkitRelativePath: '', size: 5782, …}
      // console.log(e.target.files);
      fileReader.readAsDataURL(e.target.files[0]); // ロードする。これが終わり次第onloadが発火
      // console.log(fileReader.result);
    } else {
      previewImage.src = previewImageNode.dataset.noimage;
    }
  });
</script>
@endsection