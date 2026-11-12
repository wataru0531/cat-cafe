
{{-- 
  ✅　cats作成ページ
--}}

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
        action="{{ route('admin.cats.store') }}"
        method="POST"
        enctype="multipart/form-data"
      >
        @csrf
        <div class="flex px-6 pb-4 border-b">
          <h3 class="text-xl font-bold">ねこ登録</h3>
          <div class="ml-auto">
            <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">保存</button>
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
            <label class="block text-sm font-medium mb-2" for="name">ねこ名</label>
            <!-- 
              ✅ カテゴリー名 
              requireを設定すると、ブラウザが送信を止めるので、Laravelに通知がいかず、エラー表示がなくなってしまうので設定しない。
            -->
            <input 
              id="name" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none" 
              type="text" 
              placeholder="作成したい猫の名前を入力してください。"
              {{-- required --}}
              name="name" 
              value="{{ old('name') }}"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="breed">種類</label>
            <!-- ✅ 種別 -->
            <input 
              id="breed" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none" 
              type="text" 
              placeholder="例:スノーシュー"
              {{-- required --}}
              name="breed" 
              value="{{ old('breed') }}"
            >
          </div>

          {{-- ✅ 性別 --}}
          <div class="mb-6">
            <label for="gender" class="block text-sm font-medium mb-2">性別</label>
            <div class="flex">
              <select 
                id="gender" 
                class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                {{-- required --}}
                name="gender"
              > 
                <option value="">性別を選択してください</option>
                <option value="1" {{ old("gender") == 1 ? "selected" : "" }}>オス</option>
                <option value="2" {{ old("gender") == 2 ? "selected" : "" }}>メス</option>
              </select>
              <div class="pointer-events-none transform -translate-x-1/2 flex items-center px-2 text-gray-500">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                </svg>
              </div>
            </div>
          </div>

          {{-- ✅ 生年月日 --}}
          <div class="mb-6">
            <label for="date_of_birth" class="block text-sm font-medium mb-2">生年月日</label>
            <input 
              type="date"
              id="date_of_birth"
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none"
              {{-- required --}}
              name="date_of_birth"
              value="{{ old('date_of_birth') }}"
            >
          </div>

          {{-- ✅ 画像 --}}
          <div class="mb-6">
            <label for="" class="block text-sm font-medium mb-2">画像</label>
            <div class="flex items-end">
              <img 
                id="previewImage"
                class="rounded shadow-md w-64"
                src="/images/admin/noimage.jpg" 
                data-noimage="/images/admin/noimage.jpg"
                alt="" 
              >
              <input
                type="file"
                id="image"
                class="block w-ful px-4 py-3 mb-2"
                accept="image/*"
                {{-- required --}}
                name="image"
              >
            </div>
          </div>

          {{-- ✅ 紹介文 --}}
          <div class="mb-6">
            <label for="introduction" class="block text-sm font-medium mb-2">紹介文</label>
            <textarea
              type="text"
              id="introduction"
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
              {{-- required --}}
              rows="5"
              placeholder="猫の紹介文を入力してください"
              name="introduction"
            >{{ old("introduction") }}
            </textarea>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
  // ねこちゃんたち追加
  // ✅ TODO
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