
{{-- 
  ✅ ねこ一覧ページ
--}}


@extends('layouts.default')
@section('title', 'ねこちゃんたち')

@section('content')
<section class="bg-gray-100">
  <div class="container mx-auto">
    <p class="text-left px-4 pt-2">
      <a href="{{ route('home.index') }}" class="text-blue-600 hover:underline">ホーム</a>
      &gt;ねこちゃんたち
    </p>
    <p class="text-center pt-10 text-2xl">ねこちゃんたち</p>
    <h1 class="mt-2 text-4xl font-bold font-heading text-center h-32">この子達があなたを癒やしてくれます！</h1>
  </div>
</section>

<section class="py-20 bg-blueGray-50">
  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap">

      @forelse($cats as $cat)
        <div class="w-full md:w-1/2 py-5 md:px-5">
          <div class="px-6 bg-white shadow rounded h-full py-10">
            <div class="flex items-center mb-4">
              <img 
                class="h-16 w-16 rounded-full object-cover" 
                src="{{
                  $cat->image && file_exists(public_path('storage/' . $cat->image))
                  ? asset('storage/' . $cat->image)
                  : asset('images/noimage.jpg')
                }}" 
                alt="{{ $cat->name }}"
              >
              <div class="pl-4">
                <p class="text-xl">{{ $cat->name }}</p>
                <p class="text-blueGray-400">
                  {{ $cat->breed }}{{ $cat->gender === 1 ? "♂" : "♀" }}({{ $cat->age }}さい)
                </p>
              </div>
            </div>
            <p class="leading-loose text-blueGray-400 mb-5 whitespace-pre-line">
              {{ $cat->introduction }}
            </p>
            <div class="text-right">
              <a href="{{ route('cats.show', ['catId' => $cat->id]) }}" class="inline-block px-3 py-1 rounded-xs bg-pink-200">{{ $cat->name }}の詳細</a>
            </div>
          </div>
        </div>
      @empty
        <p>猫の登録がありません。</p>
      @endforelse
        
    </div>
  </div>

  <div class="mt-6">
    {{ $cats->onEachSide(2)->links() }}
  </div>
</section>
@endsection