<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-2xl font-semibold mb-4">Edit Article</h2>

            <form id="updateForm" action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    Current thumbnail
                    <img src="{{ asset('storage/' . $article->thumbnail) }}">
                    <label for="thumbnail" class="block mb-2 text-sm font-medium">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    @error('thumbnail')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="title" class="block mb-2 text-sm font-medium">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                    <textarea name="description" id="description" rows="5" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('description', $article->description) }}</textarea>
                    @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="block mb-2 text-sm font-medium">Content</label>
                    <textarea name="content" id="content" rows="10" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="topics" class="block mb-2 text-sm font-medium">Topics</label>
                    <input type="text" name="topics" id="topics" value="{{ old('topics', $article->topics) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <span class="text-gray-500">Separate topics with commas</span>
                    @error('topics')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="visible" id="visible" {{ old("visible", $article->is_public) ? "checked" : '' }}>
                        <span class=" ml-2">Visible</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('index') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        Cancel
                    </a>
                    <button id="updateButton" type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition">
                        Update
                    </button>
                </div>
            </form>
            <form action="{{ route('article.destroy', $article) }}" method="POST">
                @csrf
                @method('DELETE')
                <button id="deleteButton" type="submit" class="inline-flex items-center px-4 py-2 bg-white-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest focus:outline-none disabled:opacity-25 transition">
                    Delete
                </button>

                <script>
                    const targetColor = "red";
                    document.getElementById('deleteButton').onclick = (event) => {
                        if (event.target.style.backgroundColor != targetColor) {
                            event.preventDefault();
                            event.target.style.backgroundColor = targetColor;
                            setTimeout(() => {
                                event.target.style.backgroundColor = "white";
                            }, 250)
                        }
                    };
                </script>
            </form>
        </div>
    </div>

</x-app-layout>