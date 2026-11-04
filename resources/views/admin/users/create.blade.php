
<!-- 
  create.blade.php
  ユーザー作成画面
  
  ・誰でもユーザー登録できないようにする
-->

@extends('layouts.admin')

@section('content')

<section class="py-8">
  <div class="container px-4 mx-auto">
    <div class="py-4 bg-white rounded">
      <form 
        action="{{ route('admin.users.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
      >
        @csrf
        <div class="flex px-6 pb-4 border-b">
          <h3 class="text-xl font-bold">ユーザ登録</h3>
          <div class="ml-auto">
            <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">登録</button>
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
            <input 
              id="name" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none focus:outline-none" 
              type="text" 
              name="name" 
              value="{{ old('name') }}"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
            <input 
              id="email" 
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded outline-none focus:outline-none" 
              type="email" 
              name="email" 
              value="{{ old('email') }}"
            >
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="password">パスワード</label>
            <div class="relative">
              <input 
                id="password" 
                class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded  outline-none focus:outline-none" 
                type="password" 
                name="password"
              >

              {{-- ✅ パスワード --}}
              {{-- 
                aria-label ...ボタンに名前をつけるための属性
                area-pressed ... ボタンの状態がONなのかOFFなのか、その状態を伝える属性
              --}}
              <button
                {{-- id="togglePassword" --}}
                data-password-toggle="password"
                data-password-label="パスワード"
                type="button"
                class="outline-none focus:outline-none absolute top-1/2 right-5 -translate-y-3"
                aria-label="パスワードを表示する"
                aria-pressed="false"
                {{-- disabled --}}
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  data-eye
                  id="eyeIcon"
                  class="h-6 w-6 text-blueGray-300" 
                  width="32" 
                  height="32" 
                  fill="#cbd5e1" 
                  viewBox="0 0 256 256"
                >
                  <path 
                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"
                  />
                </svg>
                <svg 
                  style="display: none;"
                  xmlns="http://www.w3.org/2000/svg" 
                  data-eye-off
                  id="eyeOffIcon" 
                  class="h-6 w-6 text-blueGray-300" 
                  fill="#cbd5e1" 
                  viewBox="0 0 256 256"
                >
                  <path 
                    d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a32,32,0,0,1-41.67-45.85ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.39,47.35-49.38l18,19.75a48,48,0,0,0,63.66,70l14.73,16.2A112,112,0,0,1,128,192Zm6-95.43a8,8,0,0,1,3-15.72,48.16,48.16,0,0,1,38.77,42.64,8,8,0,0,1-7.22,8.71,6.39,6.39,0,0,1-.75,0,8,8,0,0,1-8-7.26A32.09,32.09,0,0,0,134,96.57Zm113.28,34.69c-.42.94-10.55,23.37-33.36,43.8a8,8,0,1,1-10.67-11.92A132.77,132.77,0,0,0,231.05,128a133.15,133.15,0,0,0-23.12-30.77C185.67,75.19,158.78,64,128,64a118.37,118.37,0,0,0-19.36,1.57A8,8,0,1,1,106,49.79,134,134,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,131.26Z"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="password_confirmation">パスワード(確認)</label>
            <div class="relative">
              <input 
                id="password_confirmation" 
                class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded  outline-none focus:outline-none" 
                type="password" 
                name="password_confirmation"
              >

              {{-- ✅ 確認用パスワード --}}
              <button
                {{-- id="togglePassword" --}}
                data-password-toggle="password_confirmation"
                data-password-label="確認用パスワード"
                type="button"
                class="outline-none focus:outline-none absolute top-1/2 right-5 -translate-y-3"
                aria-label="パスワードを表示する"
                aria-pressed="false"
                {{-- disabled --}}
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  data-eye
                  id="eyeIcon"
                  class="h-6 w-6 text-blueGray-300" 
                  width="32" 
                  height="32" 
                  fill="#cbd5e1" 
                  viewBox="0 0 256 256"
                >
                  <path
                    
                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"
                  />
                </svg>

                <svg 
                  style="display: none;"
                  xmlns="http://www.w3.org/2000/svg" 
                  data-eye-off
                  id="eyeOffIcon" 
                  class="h-6 w-6 text-blueGray-300" 
                  fill="#cbd5e1" 
                  viewBox="0 0 256 256"
                >
                  <path 
                    
                    d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a32,32,0,0,1-41.67-45.85ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.39,47.35-49.38l18,19.75a48,48,0,0,0,63.66,70l14.73,16.2A112,112,0,0,1,128,192Zm6-95.43a8,8,0,0,1,3-15.72,48.16,48.16,0,0,1,38.77,42.64,8,8,0,0,1-7.22,8.71,6.39,6.39,0,0,1-.75,0,8,8,0,0,1-8-7.26A32.09,32.09,0,0,0,134,96.57Zm113.28,34.69c-.42.94-10.55,23.37-33.36,43.8a8,8,0,1,1-10.67-11.92A132.77,132.77,0,0,0,231.05,128a133.15,133.15,0,0,0-23.12-30.77C185.67,75.19,158.78,64,128,64a118.37,118.37,0,0,0-19.36,1.57A8,8,0,1,1,106,49.79,134,134,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,131.26Z"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div class="mb-6">
            <label class="block text-sm font-medium mb-2" for="image">画像</label>
            <div class="flex items-end">
              <img 
                id="previewImage" 
                src="/images/admin/noimage.jpg" 
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
              class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded  outline-none focus:outline-none" 
              name="introduction" 
              rows="2"
            >{{ old('introduction') }}</textarea>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
  // ✅ 画像プレビュー
  document.getElementById('image').addEventListener('change', e => {
    const previewImageNode = document.getElementById('previewImage')
    const fileReader = new FileReader()
    fileReader.onload = () => previewImageNode.src = fileReader.result
    if (e.target.files.length > 0) {
        fileReader.readAsDataURL(e.target.files[0])
    } else {
        previewImageNode.src = previewImageNode.dataset.noimage
    }
  });


  // ✅ パスワードのアイコンの表示、非表示切り替え
  document.querySelectorAll("[data-password-toggle]").forEach(button => {
    // console.log(button); // buttonタグ

    // data属性から対象のinputを取得
    // console.log(button.dataset.passwordToggle); // password password_confirmation
    const input = document.getElementById(button.dataset.passwordToggle);
    // console.log(input); // 通常inputタグ 確認用inputタグ 

    // 対応するSVGを取得
    const eyeIcon = button.querySelector("[data-eye]");
    const eyeOffIcon = button.querySelector("[data-eye-off]");
    // console.log(eyeIcon); // 開いているsvgアイコン
    // console.log(eyeOffIcon); // 閉じているsvgアイコン

    // アイコンをクリックしたとき
    button.addEventListener("click", () => {
      const isPassword = input.type === "password";
      input.type = isPassword ? "text" : "password"; // inputのtypeを切り替える

      eyeIcon.style.display = isPassword ? "none" : "block";
      eyeOffIcon.style.display = isPassword ? "block" : "none";

      // アクセシビリティ属性を更新
      button.setAttribute("aria-label", `${button.dataset.passwordLabel}を${isPassword ? "隠す" : "表示する"}`);
      button.setAttribute("aria-pressed", String(isPassword));
    });
  });

</script>

@endsection