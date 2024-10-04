<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('いいねした投稿') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('tweets.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">Tweet一覧に戻る</a>
          
          @foreach ($likedTweets as $tweet)
            <div class="mt-4 border-t pt-4">
              <p class="text-gray-800 dark:text-gray-300 text-lg">{{ $tweet->tweet }}</p>
              <p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $tweet->user->name }}</p>
              <div class="text-gray-600 dark:text-gray-400 text-sm">
                <p>作成日時: {{ $tweet->created_at->format('Y-m-d H:i') }}</p>
                <p>更新日時: {{ $tweet->updated_at->format('Y-m-d H:i') }}</p>
              </div>
              
              <div class="flex mt-2">
                <a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">詳細</a>
                
                <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:text-red-700">いいね解除 {{$tweet->liked->count()}}</button>
                </form>
              </div>
              
              <div class="mt-2">
                <p class="text-gray-600 dark:text-gray-400 ml-4">コメント数: {{ $tweet->comments->count() }}</p>
              </div>
            </div>
          @endforeach
          
          @if($likedTweets->isEmpty())
            <p class="mt-4 text-gray-600 dark:text-gray-400">いいねした投稿はありません。</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>