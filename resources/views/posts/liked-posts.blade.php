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

<body>
    <x-navigation :post="$post"></x-navigation>

    <h2 class="font-bold pl-2 text-2xl">Liked Posts</h2>

    @if ($likedPosts->count() > 0)
        @foreach ($likedPosts as $likedPost)
                <div class="flex bg-white shadow-lg rounded-lg mx-2 my-8">
                    <div class="flex items-start px-4 py-6 w-full">
                        @if ($likedPost->post->user->profile_picture)
                        <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/storage/profile_pictures/' . $likedPost->post->user->profile_picture) }}">
                    @else
                        <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/images/anonymous.png') }}">
                    @endif                
                        <div class="w-full">
                            <div class="flex items-center justify-between w-full">
                                <h2 class="text-lg font-semibold text-gray-900 -mt-1">{{$likedPost->post->user->name}}</h2>
                                <small class="text-sm text-gray-700">{{ $likedPost->post->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="text-gray-700">Joined {{$likedPost->post->user->created_at->format('d M Y')}}</p>
                            <h2 class="mt-3 font-bold text-lg">{{ $likedPost->post->title }}</h2>
                            <p class="mt-3 text-gray-700 text-sm">{{ $likedPost->post->content }}</p>
                            <div class="flex justify-between w-full">
                                <div class="mt-4 flex items-center">
                                    <div class="flex text-gray-700 text-sm mr-4">
                                        @php
                                        $likedPosts = session()->get('liked_posts', []);
                                        $isLiked = in_array($likedPost->post->id, $likedPosts);
                                    @endphp
                                    
                                    <form action="{{ route('like-post') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $likedPost->post->id }}">
                                        <button type="submit" class="inline-flex items-center py-2 text-base font-medium rounded-md text-gray-700 bg-white">
                                            <span class="{{ $isLiked ? 'text-red-600' : 'text-gray-400 hover:text-red-600' }} mr-2">
                                                <svg fill="{{ $isLiked ? 'red' : 'none' }}" viewBox="0 0 24 24" class="w-5 h-5">
                                                    <path stroke="{{ $isLiked ? 'none' : 'currentColor' }}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </span>
                                            <span>{{ $likedPost->post->likesCount() }}</span>
                                        </button>                                                                                                                                   
                                    </form> 
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-end">
                                    <button
                                        class="rounded-lg px-4 py-2 text-blue-600 hover:bg-blue-600 hover:text-white duration-300"><a
                                            href="/posts/{{ $likedPost->post['id'] }}/edit"><i class="fa-solid fa-pen-to-square"></i> <span
                                                class="md:hidden">Edit</span></a>
                                    </button>
                                    <form action="/posts/{{ $likedPost->post['id'] }}" method="POST">
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
    @else
        <p class="pl-2 text-base">No saved posts yet.</p>
    @endif

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
                        this.isSidebarOpen = false;
                    }
                }
            }
        }

        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }

    </script>
</body>

</html>
