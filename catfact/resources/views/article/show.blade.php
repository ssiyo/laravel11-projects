<x-app-layout>
    <div class="bg-gray-800 text-white shadow-md rounded-lg p-4">
        <h1 class="text-2xl font-bold">{{ $article->title }}</h1>
        <p class="text-gray-200">{{ $article->description }}</p>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/sindresorhus/github-markdown-css/github-markdown.min.css">
        <style>
            ol {
                list-style: auto;
            }
            ul {
                list-style: disc;
            }
        </style>
        <div class="py-4">
            <img style="max-width:100%;max-height:100vh;" src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="mx-auto object-cover rounded my-4">

            <div class="markdown-body bg-gray-800 rounded">
                <div class="my-4 p-2 text-white">
                    {!! $article->content !!}
                </div>
            </div>
        </div>



        <div class=" flex items-center mb-2 gap-1">
            @foreach(explode(',', $article->topics) as $topic)
            <form action="{{route('index')}}" method="get" class="mr-2 mb-2">
                <button>
                    <input type="hidden" name="topics" value="{{$topic}}">
                    <span class="bg-gray-950 text-white px-2 py-1 rounded-md">#{{ trim($topic) }}</span>
                </button>
            </form>
            @endforeach
        </div>

        @if(Auth::check())
        <form style="width:fit-content;" class="mt-6 mx-auto" action="{{ route('article.like', $article->id) }}" method="post">
            @else
            <form style="width:fit-content;" class="mt-6 mx-auto" action="{{ route('register') }}">
                @endif
                @csrf

                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition">
                    @if(Auth::check() && $article->likes()->where("user_id", Auth::user()->id)->count())
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="white" viewBox="0 0 24 24" stroke="white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    @endif
                    <span class="ml-2">
                        <span class="text-base">{{ $article->likes->count() }}</span>
                        Likes
                    </span>
                </button>
            </form>

            <div class="mt-8">
                <h2 class="text-xl font-semibold">
                    {{$article->comments->count()}}
                    Comments
                </h2>

                <div class="mt-4">
                    @if(Auth::check())
                    <form action="{{ route('comment.store') }}" method="POST">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @else
                        <form action="{{ route('register') }}">
                            @endif

                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">

                            <div class="mb-1">
                                <textarea placeholder="Comment" name="content" id="content" rows="5" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"></textarea>
                            </div>

                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition">
                                Post Comment
                            </button>
                        </form>
                </div>

                <div class="mt-8">
                    @foreach ($article->topComments as $reply)
                    @php
                    \App\Helpers\CommentHelper::displayReplies($reply);
                    @endphp
                    @endforeach
                </div>
            </div>
    </div>

    <!-- REPLYING -->
    <style>
        #reply-window {
            display: none;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            position: fixed;
            /* Stay in place */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
            background-color: rgba(0, 0, 0, 0.8);
        }

        #reply-window>div {
            width: 100%;
            max-width: 40em;
        }
    </style>
    <div id="reply-window">
        <div class="rounded-lg bg-gray-100 p-4">
            <div class="flex items-center">
                <p id="parentreply-created" class="text-xs text-gray-500"></p>
            </div>
            <div class="mt-2">
                <p id="parentreply-content"></p>
            </div>
            <form action="{{ route('comment.store') }}" method="post">
                @csrf
                @if(Auth::check())
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                @endif
                <input id="parentreply-id" type="hidden" name="parent_id">
                <input type="hidden" name="article_id" value="{{ $article->id }}">

                <div class="mb-1">
                    <textarea placeholder="Reply" name="content" id="content" rows="5" class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 shadow-sm"></textarea>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="focus:shadow-outline rounded bg-blue-500 px-2 py-1 font-bold text-white hover:bg-blue-700 focus:outline-none">REPLY</button>
                    <button onclick="cancelReply()" type="button" class="focus:shadow-outline rounded px-2 py-1 font-bold text-black focus:outline-none">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const comments = JSON.parse('{!! json_encode($article->comments) !!}');
        const replyWindow = document.getElementById("reply-window");

        const prCreated = document.getElementById("parentreply-created");
        const prContent = document.getElementById("parentreply-content");
        const prId = document.getElementById("parentreply-id");

        function replyTo(replyId) {
            const comment = comments.find(c => c.id == replyId);
            prCreated.textContent = comment.created_at;
            prContent.textContent = comment.content;
            prId.value = replyId;

            replyWindow.style.display = "flex";
        }

        function cancelReply() {
            replyWindow.style.display = "none";
        }
        document.querySelectorAll(".reply-comment").forEach((r) => {
            r.onclick = () => {
                replyTo(r.getAttribute("data-reply-id"))
            }
        });
    </script>

</x-app-layout>