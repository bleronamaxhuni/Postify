<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
</head>

<body class="h-screen">
    <x-navigation :post="$post"></x-navigation>
    
    <div class="flex w-full justify-center p-3  items-center">
        <div class="overflow-y-auto top-0 lg:w-8/12  p-8 rounded-lg  shadow-lg shadow-gray-300 bg-white mt-4 h-[400px]">
            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                @csrf          
                @method('PATCH')  
                <div class="form-group">
                    <label class="font-bold mb-1 text-gray-700 block" for="title">Title</label>
                    <input type="text" class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="title" name="title" value="{{old('title', $post['title'])}}" required>
                </div>
            
                <div class="form-group">
                    <label class="font-bold mb-1 text-gray-700 block" for="content">Content</label>
                    <textarea class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="content" name="content" rows="5" required>{{old('content', $post['content'])}}</textarea>
                </div>
            
                <button type="submit" class="w-full py-2 px-8 bg-indigo-600 text-white rounded hover:bg-indigo-700 mr-2">Update</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script>
        const setup = () => {
            return {
                isSidebarOpen: false
                , currentSidebarTab: null
                , isSettingsPanelOpen: false
                , isSubHeaderOpen: false
                , watchScreen() {
                    if (window.innerWidth <= 1024) {
                        this.isSidebarOpen = false
                    }
                }
            , }
        }

    </script>
</body>
</html>

