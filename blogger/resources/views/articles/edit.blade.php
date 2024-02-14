<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mt-4">
                <x-input-label :value="__('Title')" class="required"/>

            <x-text-input
                name="title"
                placeholder="{{ __('Entrer article title here') }}"
                value="{{ old('title', $article->title) }}"
            />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />

            </div>

            <div class="mt-4">
                <x-input-label :value="__('Extract')" class="required"/>
            <textarea
                name="extract"
                placeholder="{{ __('Entrer article extract here') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"

            >{{ old('extract',$article->extract)}}</textarea>
            <x-input-error :messages="$errors->get('extract')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label :value="__('Body')" class="required"/>
            <textarea
                name="body"
                placeholder="{{ __('Enter article body here') }}"
                class="tinyMce block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"

            >{{ old('body',$article->body) }}</textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label :value="__('Cover')" class="required"/>
                <input type="file" name="cover"/>
                <x-input-error :messages="$errors->get('cover')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">{{ __('update it!') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
