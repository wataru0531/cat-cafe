
<!-- 
  admin/medias/index.blade.php
  ✅ フィイルライブラリ一覧画面

  ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
  ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
  TODO
  画像create時に、名前をつけれるようにする。
  名前の編集ができるようにする。
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
      {{-- 
  id	original_name	disk	path	mime_type	size	width	height	uploaded_by	created_at	updated_at	 --}}

      @if($medias->isEmpty())
        <p>画像が登録されていません。</p>
      @else
        <div class="">
          <ul class="">
            @foreach($medias as $media)
              <li @class(['text-sm', 'bg-gray-50' => $loop->odd])>
                <img 
                  class="  object-cover rounded-md"
                  src="{{ 
                    $media->path && file_exists(public_path('storage/' . $media->path))
                    ? asset('storage/' . $media->path)
                    : asset('images/admin/noimage.jpg')
                  }}" 
                  alt="{{ $media->original_name }}"
                  loading="lazy"
                >
                <div>
                  <div class="flex items-start">
                    <div>svgアイコン</div>
                    <h3>{{ $media->original_name }}</h3>
                  </div>
                  <div class="flex justify-between">
                    <span>画像サイズ</span>
                    <span class="font-medium">
                      @if($media->width && $media->height)
                        {{ $media->width }} × {{ $media-> height }} px
                      @else
                        不明
                      @endif
                    </span>
                  </div>
                  <div class="flex justify-between">
                    <p class="font-medium">
                      {{
                        $media->size !== null
                        ? number_format($media->size / 1024, 1) . " KB"
                        : "不明"
                      }}
                    </p>
                    <p class="font-medium">{{ $media->mime_type ?? "不明" }}</p>
                  </div>
                  <p class="flex justify-between gap-2">
                    <span>アップロードユーザー</span>
                    <span class="font-medium  text-right">
                      {{ $media->uploader?->name ?? "不明" }}
                    </span>
                  </p>
                  <p class="font-medium">
                    <span>アップロード日時</span>
                    <span font-medium text-right>
                      {{ $media->created_at?->format('Y/m/d H:i') ?? "不明" }}
                    </span>
                  </p>

                  {{-- 削除ボタン --}}
                  <div>
                    <button
                      type="button"
                      class="js-delete-button"
                      data-media-name="{{ $media->original_name }}"
                      data-media-id="{{ $media->id }}"
                      data-delete-url="{{ route('admin.medias.destroy', $media->id) }}"
                    >
                      <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.33333 15C8.55435 15 8.76631 14.9122 8.92259 14.7559C9.07887 14.5996 9.16667 14.3877 9.16667 14.1667V9.16666C9.16667 8.94564 9.07887 8.73368 8.92259 8.5774C8.76631 8.42112 8.55435 8.33332 8.33333 8.33332C8.11232 8.33332 7.90036 8.42112 7.74408 8.5774C7.5878 8.73368 7.5 8.94564 7.5 9.16666V14.1667C7.5 14.3877 7.5878 14.5996 7.74408 14.7559C7.90036 14.9122 8.11232 15 8.33333 15ZM16.6667 4.99999H13.3333V4.16666C13.3333 3.50362 13.0699 2.86773 12.6011 2.39889C12.1323 1.93005 11.4964 1.66666 10.8333 1.66666H9.16667C8.50363 1.66666 7.86774 1.93005 7.3989 2.39889C6.93006 2.86773 6.66667 3.50362 6.66667 4.16666V4.99999H3.33333C3.11232 4.99999 2.90036 5.08779 2.74408 5.24407C2.5878 5.40035 2.5 5.61231 2.5 5.83332C2.5 6.05434 2.5878 6.2663 2.74408 6.42258C2.90036 6.57886 3.11232 6.66666 3.33333 6.66666H4.16667V15.8333C4.16667 16.4964 4.43006 17.1322 4.8989 17.6011C5.36774 18.0699 6.00363 18.3333 6.66667 18.3333H13.3333C13.9964 18.3333 14.6323 18.0699 15.1011 17.6011C15.5699 17.1322 15.8333 16.4964 15.8333 15.8333V6.66666H16.6667C16.8877 6.66666 17.0996 6.57886 17.2559 6.42258C17.4122 6.2663 17.5 6.05434 17.5 5.83332C17.5 5.61231 17.4122 5.40035 17.2559 5.24407C17.0996 5.08779 16.8877 4.99999 16.6667 4.99999ZM8.33333 4.16666C8.33333 3.94564 8.42113 3.73368 8.57741 3.5774C8.73369 3.42112 8.94565 3.33332 9.16667 3.33332H10.8333C11.0543 3.33332 11.2663 3.42112 11.4226 3.5774C11.5789 3.73368 11.6667 3.94564 11.6667 4.16666V4.99999H8.33333V4.16666ZM14.1667 15.8333C14.1667 16.0543 14.0789 16.2663 13.9226 16.4226C13.7663 16.5789 13.5543 16.6667 13.3333 16.6667H6.66667C6.44565 16.6667 6.23369 16.5789 6.07741 16.4226C5.92113 16.2663 5.83333 16.0543 5.83333 15.8333V6.66666H14.1667V15.8333ZM11.6667 15C11.8877 15 12.0996 14.9122 12.2559 14.7559C12.4122 14.5996 12.5 14.3877 12.5 14.1667V9.16666C12.5 8.94564 12.4122 8.73368 12.2559 8.5774C12.0996 8.42112 11.8877 8.33332 11.6667 8.33332C11.4457 8.33332 11.2337 8.42112 11.0774 8.5774C10.9211 8.73368 10.8333 8.94564 10.8333 9.16666V14.1667C10.8333 14.3877 10.9211 14.5996 11.0774 14.7559C11.2337 14.9122 11.4457 15 11.6667 15Z" fill="#E85444"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- ページネーション --}}
        {{ $medias->links() }}
      @endif
    </div>
  </div>


  {{-- 削除モーダル ⭐️TODO 後から追加　--}}
  <div
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    id="deleteModal"
  >
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
      <h2>ユーザー削除の確認</h2>
      <p class="mb-6 tex-gray-600">
        <span id="deleteMediaName" class="font-bold"></span>
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
    const deleteMediaName = document.getElementById("deleteMediaName");
    const deleteForm = document.getElementById("deleteForm");
    const cancelDelete = document.getElementById("cancelDelete");

    deleteButtons.forEach(button => {
      button.addEventListener("click", () => {
        const mediaId = button.dataset.mediaId;
        const mediaName = button.dataset.mediaName;

        deleteMediaName.textContent = mediaName;
        // 送信先のactionを設定
        // web.phpのルートにURLで渡す
        deleteForm.action = `/admin/medias/${mediaId}`; 
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