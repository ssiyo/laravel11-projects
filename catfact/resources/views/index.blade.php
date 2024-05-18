<x-app-layout>
    <!-- BACK TO TOP -->
    <a href="#" style="bottom:1em;right:50%;transform:translateX(50%);background-color:rgba(0,0,0,0.5);" class="fixed text-white px-2 py-1 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </a>
    <!-- SEARCH FORM -->
    <form action="{{ route('index') }}" method="GET" class="bg-gray-800 p-4">
        <div class="flex gap-6">
            <div class="w-full">
                <div>
                    <label class="block text-white text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Search by title">
                </div>
                @if(Auth::check())
                <div class="mb-4">
                    <label class="block text-white text-sm font-bold mb-2" for="liked">
                        <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="liked" name="liked" type="checkbox">
                        Liked
                    </label>
                </div>
                @endif
            </div>
            <div class="w-full">
                <div>
                    <label class="block text-white text-sm font-bold mb-2" for="topics">
                        Topics
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="topics" name="topics" type="text" placeholder="Separate by commas ,">
                </div>
                @if(Auth::check())
                <div class="mb-4">
                    <label class="block text-white text-sm font-bold mb-2" for="interests">
                        <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="interests" type="checkbox">
                        Interests
                    </label>
                </div>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
            <a class="text-blue-500 hover:text-blue-700" href="{{ route('index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        </div>
    </form>
    <script>
        document.getElementById("interests").onclick = (event) => {
            if (event.target.checked) {
                document.getElementById("topics").value = '{!! $interests !!}';
            } else {
                document.getElementById("topics").value = '';
            }
        }
    </script>

    @if(Auth::check() && isset($topic) && !empty($topic))
    <form method="post" action="{{ route('interests.check') }}" class="mx-auto font-bold py-2 px-4 rounded mb-8 block {{$interested ? 'bg-transparent hover:bg-red-950 text-red-400':'bg-green-700 hover:bg-green-900 text-white'}}" style="width: fit-content;">
        @csrf
        <input type="hidden" name="topic" value="{{$topic}}">
        <button class="flex">
            @if($interested)
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
            @else
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            @endif
            "{{ $topic }}" {{$interested ? "from":"to"}} Interests
        </button>
    </form>
    @endif

    <!-- ARTICLES -->

    <div class="grid grid-cols-1 gap-4 mt-4">
        @foreach($articles as $article)
        <a href="{{ Auth::user() && Auth::user()->is_admin ? route('article.edit', $article) : route('article.show', $article) }}" class="flex bg-white dark:bg-gray-800 rounded-lg shadow-md p-1" style="background-color:{{$article->is_public ? 'white':'pink'}}">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" style="object-fit:cover;" class="h-64 w-64 rounded-md mr-4">
            <div>
                <h2 class=" text-xl font-bold text-black mb-2">
                    {{$article->title}}
                </h2>
                <p class="text-gray-700 mb-2">
                    {{$article->description}}
                </p>
                <div class="flex items-center mb-2 gap-1">
                    @foreach(explode(',', $article->topics) as $topic)
                    <span class="bg-gray-800 text-white px-2 py-1 rounded-md">
                        #{{trim($topic)}}
                    </span>
                    @endforeach
                </div>
                <span class="text-gray-400">
                    on {{$article->created_at}}
                </span>
                @if($article->is_public)
                <div class="flex items-center gap-4 mt-4">
                    <div class="flex items-center gap-2 p-1 pr-2 rounded bg-slate-200 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="blue" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="font-medium text-gray-700">
                            {{$article->likes->count()}}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 p-1 pr-2 rounded bg-slate-200 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 -960 960 960" fill="green">
                            <path d="M240-400h480v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM880-80 720-240H160q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720ZM160-320h594l46 45v-525H160v480Zm0 0v-480 480Z" />
                        </svg>
                        <span class="font-medium text-gray-700">
                            {{$article->comments->count()}}
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </a>
        @endforeach
    </div>
    <!-- PAGINATION -->
    {{ $articles->links() }}

</x-app-layout>