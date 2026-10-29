
{{-- 
  ✅ お問い合わせ詳細ページ
  
--}}

@extends('layouts.admin')

@section('content')
<section class="py-8">
  <div class="container px-4 mx-auto">
    <div class="py-4 bg-white rounded">
      <div class="px-6 pb-4 border-b">
        <h3 class="text-xl font-bold">お問い合わせ | 管理者確認用</h3>
      </div>

      {{-- バリデーションエラー --}}
      @if($errors->any())
        <div class="mb-4 text-red-600">
          <ul>
            @foreach($errors as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- 更新成功メッセージ --}}
      @if(session("success"))
        <div class="mb-4 text-green-600">
          {{ session("success") }}
        </div>
      @endif

      <form 
        action="{{ route('admin.contacts.updateAdminDetails', ['contactId' => $contact->id]) }}"
        method="POST"
        class="pt-4 px-6"
      >
        @csrf
        @method("PATCH")

        <div class="mb-6">
          <label class="block text-sm font-medium mb-2" for="name">お名前</label>
          <input 
            id="name"
            class="block w-96 max-w-full px-4 py-3 mb-2 text-sm text-gray-500 border rounded" 
            type="text" 
            disabled 
            value="{{ $contact->name }}"
          >
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium mb-2" for="name_kana">お名前（フリガナ）</label>
          <input 
            id="name_kana" 
            class="block w-96 max-w-full px-4 py-3 mb-2 text-sm text-gray-500 border rounded" 
            type="text" 
            disabled 
            value="{{ $contact->name_kana }}"
          >
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium mb-2" for="phone">電話番号</label>
          <input 
            id="phone" 
            class="block w-96 max-w-full px-4 py-3 mb-2 text-sm text-gray-500 border rounded" 
            type="text" 
            disabled 
            value="{{ $contact->phone }}"
          >
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
          <input 
            id="email" 
            class="block w-96 max-w-full px-4 py-3 mb-2 text-sm text-gray-500 border rounded" 
            type="email" 
            disabled 
            value="{{ $contact->email }}"
          >
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium mb-2" for="body">本文</label>
          <textarea 
            id="body" 
            class="block w-full px-4 py-3 mb-2 text-sm text-gray-500 border rounded" 
            name="field-name" 
            rows="5" 
            disabled
          >
            {{ $contact->body }}
          </textarea>
        </div>

        {{-- ✅ 対応状況 --}}
        {{-- 
          @selected() ... DBに保存されている対応状況を初期選択にする。trueならselectedを使う
          old() ... セッションにis_completedがあればそれをつかう、
                    なければ、DBのis_completedを使う。初期値
                    
        --}}
        <div class="mb-6">
          <label for="is_completed" class="block text-sm font-medium mb-2">対応状況</label>
          <div class="flex">
            <select 
              id="is_completed"
              {{-- class="block w-96 max-w-full px-4 py-3 text-sm border rounded" --}}
              class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
              name="is_completed"
            >
              <option 
                value="0"
                @selected(old('is_completed', $contact->is_completed) == 0)
              >未対応</option>
              <option 
                value="1"
                @selected(old('is_completed', $contact->is_completed) == 1)
              >対応済み</option>
            </select>

            <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
              </svg>
            </div>
          </div>
        </div>

        {{-- ✅ 管理者メモ --}}
        {{-- 改行などは削除しないようにする --}}
        <div class="mb-6">
          <label for="admin_note" class="block text-sm font-medium mb-2">管理者メモ</label>
          <textarea 
            id="admin_note"
            class="block w-full px-4 py-3 text-sm border rounded"
            name="admin_note" 
            rows="5"
            max-length="5000"
            placeholder="対応内容や申し送りを入力してください"
          >{{ old('admin_note', $contact->admin_note) }}
          </textarea>
        </div>

        <button
          class="px-5 py-3 text-white bg-indigo-600 hover:bg-indigo-700 rounded"
          type="submit"
        >
          保存する
        </button>


      </form>
    </div>
  </div>
</section>
@endsection