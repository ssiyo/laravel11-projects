<x-app-layout>
    <!-- create.blade.php -->

    <div class="container mx-auto py-4 max-w-xl">
        <h1 class="text-3xl text-white font-semibold mb-4">Create New Article</h1>

        <form action="{{ route('article.store') }}" method="POST" class="mx-auto" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="thumbnail" class="block text-gray-200 font-bold mb-2">Thumbnail</label>
                <input autofocus type="file" id="thumbnail" name="thumbnail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label for="title" class="block text-gray-200 font-bold mb-2">Title</label>
                <input autofocus type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-200 font-bold mb-2">Description</label>
                <textarea autofocus id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label for="topics" class="block text-gray-200 font-bold mb-2">Topics</label>
                <input autofocus type="text" id="topics" name="topics" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
                <x-input-error :messages="$errors->get('topics')" class="mt-2" />
            </div>

            <!-- Add more form fields as needed -->

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Article</button>
            </div>
        </form>
    </div>

</x-app-layout>