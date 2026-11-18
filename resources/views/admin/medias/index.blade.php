
<!-- 
  admin/medias/index.blade.php
  ✅ フィイルライブラリ一覧画面

  ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
  ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
  TODO
  画像登録から。
  画像一覧をつくる
-->

@extends('layouts.admin')

@section('content')
<section>
  <div class="mb-6 py-4 bg-white rounded">
    <div class="flex px-6 pb-4 border-b">
      <h2 class="text-xl font-bold">ファイルライブラリ一覧</h2>
      <div class="ml-auto">
        <a 
          href="{{ route('admin.medias.create') }}" 
          class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md"
        >新規投稿</a>
      </div>
    </div>

    <div class="pt-4 px-4 overflow-x-auto">

      @if($medias->isEmpty())
        <p>画像が登録されていません。</p>
      @else
        <ul>
          @foreach($medias as $media)
            <li @class(['text-sm', 'bg-gray-50' => $loop->odd])>
              {{ $media->original_name }}
            </li>
          @endforeach
        </ul>

        {{-- ページネーション --}}
        {{ $medias->links() }}

      @endif
    </div>
  </div>


  {{-- 削除モーダル --}}
  <div
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    id="deleteModal"
  >
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
      <h2>ユーザー削除の確認</h2>
      <p class="mb-6 tex-gray-600">
        <span id="deleteCatName" class="font-bold"></span>
        を削除してもよろしいですか？
      </p>

      <div class="flex justify-end gap-3">
        {{-- キャンセルボタン --}}
        <button 
          class="px-4 py-2 bg-gray-200 rounded"
          id="cancelDelete"
        >キャンセル</button>

        {{-- 
          削除確定ボタン 
          → actionには最初から設定せずJSから指定
        --}}
        <form
          action="" 
          method="POST"
          id="deleteForm"
        >
          @csrf
          @method("DELETE")
          <button
            type="submit"
            class="px-4 py-2 text-white bg-red-500 rounded"
          >
            削除する
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- 
    ✅ ページャー　
    → Laravelが paginate() の結果を見て、自動的にページネーション用のHTMLを生成する
  -->
  
</section>

<script>
  // console.log("hello");
    // 削除ボタンはユーザーの数だけ存在するので
    const deleteButtons = document.querySelectorAll(".js-delete-button");

    const deleteModal = document.getElementById("deleteModal");
    const deleteCatName = document.getElementById("deleteCatName");
    const deleteForm = document.getElementById("deleteForm");
    const cancelDelete = document.getElementById("cancelDelete");

    deleteButtons.forEach(button => {
      button.addEventListener("click", () => {
        const catId = button.dataset.catId;
        const catName = button.dataset.catName;

        deleteCatName.textContent = catName;
        // 送信先のactionを設定
        // web.phpのルートにURLで渡す
        deleteForm.action = `/admin/cats/${catId}`; 
        deleteModal.classList.remove("hidden");
        deleteModal.classList.add("flex");
      })
    });

    cancelDelete.addEventListener("click", () => {
      deleteModal.classList.add("hidden");
      deleteModal.classList.remove("flex");
    });

    deleteModal.addEventListener("click", (e) => {
      // console.log(e.target === deleteModal);
      // console.log(deleteModal);
      if(e.target === deleteModal) {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("flex");
      }
    })

</script>

@endsection