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
    <h2 class="font-bold pl-2 text-2xl">Dashboard</h2>
    <div class="grid grid-cols-3 gap-6 p-5">
        <div class="grid mt-5">
            <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                href="#">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <i class="fas fa-pencil-alt text-indigo-600 text-3xl ml-1"></i>
                        <div class="flex items-center gap-3">
                            <div class="mt-3 text-3xl font-bold leading-8">{{ $postCount }}</div>
                            <div class="mt-3 text-base text-gray-600">Posts</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="grid mt-5">
            <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                href="#">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <i class="fas fa-heart text-indigo-600 text-3xl ml-1"></i>
                        <div class="flex items-center gap-3">
                            <div class="mt-3 text-3xl font-bold leading-8">{{ $likeCount }}</div>
                            <div class="mt-3 text-base text-gray-600">Total Likes</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="grid mt-5">
            <a class="transform  hover:scale-105 transition duration-300 shadow-lg rounded-lg intro-y bg-white"
                href="#">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <i class="fa-solid fa-bookmark text-indigo-600 text-3xl ml-1"></i>
                        <div class="flex items-center gap-3">
                            <div class="mt-3 text-3xl font-bold leading-8">{{ $savedPostCount }}</div>
                            <div class="mt-3 text-base text-gray-600">Saved Posts</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <h2 class="font-bold pl-2 text-2xl mt-20">Latest Posts</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-3 xl:gap-0">
        @foreach($latestPosts as $post)
        <div class="flex bg-white shadow-lg rounded-lg mx-2 my-8">
            <div class="flex items-start px-4 py-6 w-full">
                    @if ($post->user->profile_picture)
                        <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/storage/profile_pictures/' . $post->user->profile_picture) }}">
                    @else
                        <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/images/anonymous.png') }}">
                    @endif                

                <div class="w-full">
                    <div class="flex items-center justify-between w-full">
                        <h2 class="text-lg font-semibold text-gray-900 -mt-1">{{$post->user->name}}</h2>
                        <small class="text-sm text-gray-700">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-gray-700">Joined {{$post->user->created_at->format('d M Y')}}</p>
                    <h2 class="mt-3 font-bold text-lg">{{ $post->title }}</h2>
                    <p class="mt-3 text-gray-700 text-sm">{{ $post->content }}</p>
                    <div class="flex justify-between w-full">
                        <div class="mt-4 flex items-center">
                            <div class="flex text-gray-700 text-sm mr-3">
                                @php
                                    $likedPosts = session()->get('liked_posts', []);
                                    $isLiked = in_array($post->id, $likedPosts);
                                @endphp
                                
                                <form action="{{ route('like-post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="inline-flex items-center py-2 text-base font-medium rounded-md text-gray-700 bg-white">
                                        <span class="{{ $isLiked ? 'text-red-600' : 'text-gray-400 hover:text-red-600' }} mr-2">
                                            <svg fill="{{ $isLiked ? 'red' : 'none' }}" viewBox="0 0 24 24" class="w-5 h-5">
                                                <path stroke="{{ $isLiked ? 'none' : 'currentColor' }}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </span>
                                        <span>{{ $post->likesCount() }}</span>
                                    </button>                                                                                                                                   
                                </form>               
                            </div>
                            <div class="flex text-gray-700 text-sm mr-8">
                                <button class="open-modal">
                                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>    
                                </button>
                                <div class="modal-container fixed z-10 inset-0 overflow-y-auto hidden bg-gray-500 bg-opacity-75">
                                    <div class="flex items-center justify-center min-h-screen">
                                        <div class="bg-white rounded-lg p-6 w-7/12">
                                            <button class="close-modal ml-4 text-gray-500 hover:text-gray-700 float-right"><i class="fas fa-times text-lg"></i></button>
                                                <h2 class="text-lg font-medium mb-4 text-center">{{$post->title}}'s Comments</h2>
                                            <form method="POST" action="{{ route('comments.store') }}">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <div>
                                                    <label class="font-bold mb-1 text-gray-700 block" for="body">Your Comment</label>
                                                    <textarea class="w-full p-2 mt-2 mb-3  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-gray-200" id="body" name="body" rows="5" required></textarea>                                    
                                                </div>
                                                <div>
                                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-4 rounded-lg">Submit</button>
                                                </div>
                                            </form>
                                            @foreach($post->comments as $comment)
                                                <div class="flex justify-center relative w-full mt-5">
                                                    <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg w-full">
                                                        <div class="relative flex gap-4 items-center">
                                                            <div class="flex flex-col  w-4/12">
                                                                @if ($post->user->profile_picture)
                                                                    <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/storage/profile_pictures/' . $post->user->profile_picture) }}">
                                                                @else
                                                                    <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/images/anonymous.png') }}">
                                                                @endif                                                                                                                        
                                                                <div class="flex flex-col justify-between">
                                                                    <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{ $comment->user->name }}</p>
                                                                    <p class="text-gray-400 text-sm">{{ $comment->created_at->toFormattedDateString() }}M</p>
                                                                </div>
                                                            </div>
                                                            <p class=" text-gray-500">{{ $comment->body }}</p>
                                                        </div>
                                                        @if(Auth::user()->id === $comment->user_id)
                                                            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-500">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach                             
                                        </div>
                                    </div>
                                </div>
                                <span>{{ $post->commentsCount() }}</span>
                            </div>
                            <div class="flex text-gray-700 text-sm mr-4">
                                @if (auth()->check())
                                    @if (auth()->user()->savedPosts()->where('post_id', $post->id)->exists())
                                        <form action="{{ route('saved-posts.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button type="submit"><i class="fa-solid fa-bookmark"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('saved-posts.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button type="submit"><i class="fa-regular fa-bookmark"></i></button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-end">
                            <button
                                class="rounded-lg px-4 py-2 text-blue-600 hover:bg-blue-600 hover:text-white duration-300"><a
                                    href="/posts/{{ $post['id'] }}/edit"><i class="fa-solid fa-pen-to-square"></i> <span
                                        class="md:hidden"></span></a>
                            </button>
                            <form action="/posts/{{ $post['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="rounded-lg px-4 py-2 text-red-600 hover:bg-red-700 hover:text-white duration-300"
                                    onclick="deleteFunction();"> <i class="fa-solid fa-trash"></i> <input type="submit"
                                        name="" value="" class="md:hidden">
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
