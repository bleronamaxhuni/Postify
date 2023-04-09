<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
</head>

<body>
    <x-navigation></x-navigation>

    <x-post-modal></x-post-modal>

    <div class="grid grid-cols-4 gap-3">
        @foreach($posts as $post)
        <div class="flex bg-white shadow-lg rounded-lg mx-2 my-8">
            <div class="flex items-start px-4 py-6 w-full">
                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                    src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                    alt="avatar">
                <div class="w-full">
                    <div class="flex items-center justify-between w-full">
                        <h2 class="text-lg font-semibold text-gray-900 -mt-1">Brad Adams </h2>
                        <small class="text-sm text-gray-700">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-gray-700">Joined 12 SEP 2012. </p>
                    <h2 class="mt-3 font-bold text-lg">{{ $post->title }}</h2>
                    <p class="mt-3 text-gray-700 text-sm">{{ $post->content }}</p>
                    <div class="flex justify-between w-full">
                        <div class="mt-4 flex items-center">
                            <div class="flex text-gray-700 text-sm mr-3">
                                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span>12</span>
                            </div>
                            <div class="flex text-gray-700 text-sm mr-8">
                                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                                <span>8</span>
                            </div>
                            <div class="flex text-gray-700 text-sm mr-4">
                                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Save</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-end">
                            <button
                                class="rounded-lg px-4 py-2 text-blue-600 hover:bg-blue-600 hover:text-white duration-300"><a
                                    href="/posts/{{ $post['id'] }}/edit"><i class="fa-solid fa-pen-to-square"></i> <span
                                        class="md:hidden">Edit</span></a>
                            </button>
                            <form action="/posts/{{ $post['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="rounded-lg px-4 py-2 text-red-600 hover:bg-red-700 hover:text-white duration-300"
                                    onclick="deleteFunction();"> <i class="fa-solid fa-trash"></i> <input type="submit"
                                        name="" value="Delete" class="md:hidden">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

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