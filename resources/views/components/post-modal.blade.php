<div class="flex w-full justify-end p-3">
    <button onclick="toggleModal()"
        class="shadow inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-4 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        New Post
    </button>
</div>

<div class="flex w-full justify-end p-3">
    <div class="overflow-y-auto top-0 lg:w-7/12  p-8 rounded-lg hidden shadow-lg shadow-gray-300 bg-white mt-4" id="modal">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <label class="font-bold mb-1 text-gray-700 block" for="title">Title</label>
                <input type="text" class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="title" name="title" required>
            </div>
        
            <div class="form-group">
                <label class="font-bold mb-1 text-gray-700 block" for="content">Content</label>
                <textarea class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="content" name="content" rows="5" required></textarea>
            </div>        
            <button type="submit" class="py-2 px-8 bg-indigo-600 text-white rounded hover:bg-indigo-700 mr-2 float-right">Post</button>
        </form>
    </div>
</div>
