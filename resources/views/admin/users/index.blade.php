
{{-- 
  ユーザー一覧ページ

  ⭐️ ここから ⭐️ ここから ⭐️ ここから ⭐️ ここから ⭐️ ここから
  ⭐️ ここから ⭐️ ここから ⭐️ ここから ⭐️ ここから

--}}

@extends("layouts.admin");


@section("content")
  <section class="py-8">
    <div class="container px-4 mx-auto">
      
      <div>users一覧ページ</div>
      <ul>
        @foreach($users as $user)
        <li>{{ $user->name }}</li>
        @endforeach
      </ul>

    </div>

  </section>
@endsection