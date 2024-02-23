<x-app-layout>
    <div class="container max-w-5xl mx-auto ">
        <span class=" mt-4 flex -center text-3xl font-bold text-gray-700">
            Profiles List
        </span>
        <div class=" mx-auto mt-6  divide-y">
            <x-action-button :url="route('register')" >
                create a new Profile
            </x-action-button>
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
                {{ $profiles->links() }}
            </div>

{{--            ARTICLES LIST--}}
            @foreach ($profiles as $profile)
                <div class="px-8 py-4 flex space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path>                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>{{$profile->name}}</div>
                            <div>{{$profile->email}}</div>
{{--                            @if ($profile->user->is(auth()->user()))--}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                         <x-dropdown-link :href="route('profile.edit', $profile)">
                                            {{ __('go to profile') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="px-8 py-2">
                {{ $profiles->links() }}
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
