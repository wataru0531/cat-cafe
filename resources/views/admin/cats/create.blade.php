
{{-- 
  ✅　カテゴリー作成ページ

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
        action="{{ route('admin.categories.store') }}"
        method="POST"
      >
        @csrf
        <div class="flex px-6 pb-4 border-b">
          <h3 class="text-xl font-bold">カテゴリー登録</h3>
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
            <label class="block text-sm font-medium mb-2" for="name">カテゴリー名</label>
            <!-- ✅ カテゴリー名 -->
            <input 
              id="name" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none" 
              type="text" 
              placeholder="カテゴリー名を入力してください。"
              required
              name="name" 
              value="{{ old('name') }}"
            >
          </div>

        </div>
      </form>
    </div>
  </div>
</section>

<script>
  // ねこちゃんたち追加
  
</script>
@endsection