<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            @if (auth()->user()->isAdmin() || auth()->user()->isEditor())
                <a href="{{ route('posts.create') }}" class="inline-block px-4 py-2 bg-gray-800 text-white rounded">Tulis Post</a>
            @endif

            @foreach ($posts as $post)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">oleh {{ $post->user->name }}</p>
                    <p class="text-gray-700 mb-3">{{ Str::limit($post->body, 150) }}</p>

                    <div class="flex gap-3 text-sm">
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:underline">Edit</a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                  onsubmit="return confirm('Hapus post ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>