<x-app-layout>
    <div class="container max-w-5xl mx-auto ">
        <span class=" mt-4 flex -center text-3xl font-bold text-gray-700">Manage Articles</span>
        <div class=" mx-auto mt-6  divide-y">
            <x-action-button :url="route('articles.create')" >create a new article</x-action-button>
        </div>
        <div class=" mx-auto mt-6 bg-white shadow-sm rounded-lg divide-y">

{{--            FLASH MESSAGE--}}
            @if(Session::has('success'))
                <div class="mt-4 flex justify-center align-center  alert alert-success
             items-center px-4 py-2 bg-green-500 border border-transparent
            font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-gray-700 active:bg-gray-900
            focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ Session::get('success') }}
                </div>
            @endif


            <div class="px-8 py-2">
                {{ $articles->links() }}
            </div>

{{--            ARTICLES LIST--}}
            @foreach ($articles as $article)
                <div class="px-8 py-4 flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $article->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $article->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($article->created_at->eq($article->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>

{{--                            @if ($article->user->is(auth()->user()))--}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('articles.publish', $article)">
                                            @if($article->published)
                                                {{ __('unpublish') }}
                                            @else
                                                {{ __('publish') }}
                                            @endif
                                        </x-dropdown-link>

                                        <x-dropdown-link :href="route('articles.edit', $article)">
                                            {{ __('view/edit') }}
                                        </x-dropdown-link>

                                        <form method="GET" action="{{ route('articles.destroy', $article) }}">
                                            @csrf
                                            @method('DELETE')
    {{--                                        <x-dropdown-link :href="route('articles.destroy', $article)" onclick="confirmDelete()">--}}
    {{--                                            {{ __('delete') }}--}}
    {{--                                        </x-dropdown-link>--}}
                                            <x-dropdown-link href="{{ route('articles.delete', $article) }}"
                                               onclick="return confirm('Are you sure you want to delete this usere?');">{{ __('delete') }}</x-dropdown-link>
                                        </form>

                                    </x-slot>
                                </x-dropdown>
{{--                            @endif--}}
                        </div>
                        <img class="object-scale-down max-h-32 mt-4 text-md text-gray-600" src="{{Storage::url($article->cover)}}"/>
                        <p class="mt-4 text-lg text-gray-900">{{ $article->title }}</p>
                        <p class="mt-4 text-md text-gray-600">{{ $article->extract }}</p>
{{--                        <p class="mt-4 text-md text-gray-600">{!! $article->body !!}</p>--}}

                        @if($article->published)
                        <p class="float-end mt-4 text-sm font-extrabold text-green-700">PUBLISHED</p>
                        @else
                        <p class="float-end mt-4 text-sm font-extrabold text-red-700">UNPUBLISHED</p>
                        @endif


                            {{--                    <p class="mt-4 text-sm text-gray-600">{!! $article->body !!}</p>--}}

                    </div>
                </div>
            @endforeach
            <div class="px-8 py-2">
                {{ $articles->links() }}
            </div>

        </div>
    </div>
</x-app-layout>



<style>
    span[aria-current="page"]>span {
        /* CSS properties go here */
        color:red;
    }
</style>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this item?');
    }
</script>
