
{{-- 
  ✅　ログインページ

  ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
  ⭐️ここから⭐️ここから⭐️ここから⭐️ここから⭐️ここから
  管理者、一般ユーザーの場合分け？
  登録ユーザーがいなければエラーだ出る。Auth::user()しているところなど

  ✅ TODO
  パスワードの部分を、クリックしたらtype="password"からtype="text"に変更する
  
--}}

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>管理者ログイン</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/css/tailwind/tailwind.min.css">

  <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
  <script src="/js/main.js"></script>
</head>
<body class="antialiased bg-body text-body font-body">
<div>
  <section class="h-screen py-48 bg-blueGray-50">
    <div class="container px-4 mx-auto">
      <div class="flex max-w-md mx-auto flex-col text-center">
        <div class="mt-12 mb-8 p-8 bg-white rounded shadow">
          <h1 class="mb-6 text-3xl">管理者ログイン</h1>

          <!-- 
            withErrors()で生成した$errorsのセッションからデータを取得する
            any() → エラーが1件でも存在するかどうか  
          -->
          @if($errors->any())
            <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
              <p class="text-red-400">ログインに失敗しました</p>
            </div>
          @endif

          <form 
            action="{{ route('admin.login') }}"
            method="POST"
          >
            @csrf
            <div class="flex mb-4 px-4 bg-blueGray-50 rounded">
              <!-- email -->
              <input 
                class="w-full py-4 text-xs placeholder-blueGray-400 font-semibold leading-none bg-blueGray-50 outline-none" 
                type="email" 
                placeholder="メールアドレス" 
                name="email" 
                value="{{ old('email') }}"
              >
              <svg class="h-6 w-6 ml-4 my-auto text-blueGray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
              </svg>
            </div>

            <div class="flex mb-6 px-4 bg-blueGray-50 rounded">
              <!-- 
                パスワード
                value ... ログインに失敗した時には、oldでセッションから取得しない
                button ... type="button"を指定しないと、submit として機能してしまう。
              -->
              <input 
                id="password"
                class="w-full py-4 text-xs placeholder-blueGray-400 font-semibold leading-none bg-blueGray-50 outline-none" 
                type="password" 
                placeholder="パスワード" 
                name="password"
              >
              <button
                id="togglePassword"
                type="button"
                class="ml-4 outline-none focus:outline-none"
                area-label="パスワードを表示する"
                area-pressed="false"
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  id="eyeIcon"
                  class="h-6 w-6 text-blueGray-300" 
                  width="32" 
                  height="32" 
                  fill="#cbd5e1" 
                  viewBox="0 0 256 256"
                >
                  <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"/>
                </svg>
                <svg 
                  style="display: none;"
                  xmlns="http://www.w3.org/2000/svg" 
                  id="eyeOffIcon" 
                  class="h-6 w-6 text-blueGray-300" 
                  fill="#cbd5e1" 
                  viewBox="0 0 256 256">
                  <path d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a32,32,0,0,1-41.67-45.85ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.39,47.35-49.38l18,19.75a48,48,0,0,0,63.66,70l14.73,16.2A112,112,0,0,1,128,192Zm6-95.43a8,8,0,0,1,3-15.72,48.16,48.16,0,0,1,38.77,42.64,8,8,0,0,1-7.22,8.71,6.39,6.39,0,0,1-.75,0,8,8,0,0,1-8-7.26A32.09,32.09,0,0,0,134,96.57Zm113.28,34.69c-.42.94-10.55,23.37-33.36,43.8a8,8,0,1,1-10.67-11.92A132.77,132.77,0,0,0,231.05,128a133.15,133.15,0,0,0-23.12-30.77C185.67,75.19,158.78,64,128,64a118.37,118.37,0,0,0-19.36,1.57A8,8,0,1,1,106,49.79,134,134,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,131.26Z"/>
                </svg>
              </button>
            </div>
            <button 
              type="submit" 
              class="block w-full p-4 text-center text-xs text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded"
            >ログイン</button>
          </form>
          {{-- <div class="mt-5 text-right">
            <a 
              href="{{ route('admin.users.create') }}"
              class="text-sm text-blue-500 hover:text-blue-700"
            >
              新規登録はこちら
            </a>
          </div> --}}
        </div>
      </div>
    </div>
  </section>

  <script>
    const password = document.querySelector("#password");
    const togglePassword = document.querySelector("#togglePassword");
    const eyeIcon = document.getElementById("eyeIcon");
    const eyeOffIcon = document.getElementById("eyeOffIcon");

    togglePassword.addEventListener("click", () => {
      // if(password.value === "") return; // 入力内容がないならreturn

      const isPassword = password.type === "password";
      password.type = isPassword ? "text" : "password"; // textに切り替える

      eyeIcon.style.display = isPassword ? "none" : "block"; // アイコンの表示、非表示の切り替え
      eyeOffIcon.style.display = isPassword ? "block" : "none";

      // アクセシビリティの更新
      togglePassword.setAttribute("aria-label", isPassword ? "パスワードを隠す" : "パスワードを表示する");
      togglePassword.setAttribute("aria-pressed", String(isPassword));
    });

  </script>
</div>
</body>
</html>
