@props(['post'])
<!-- component -->
<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');">
    <div class="flex h-screen antialiased text-gray-900 bg-gray-100">
        <!-- Loading screen -->
        <div x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-indigo-800">
            Loading.....
        </div>

        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
            <div x-show="isSidebarOpen" @click="isSidebarOpen = false"
                class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
            <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

            <!-- Mobile bottom bar -->
            <nav aria-label="Options"
                class="fixed inset-x-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-indigo-100 sm:hidden shadow-t rounded-b-3xl">
                <!-- Menu button -->
                <button
                    @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                    class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                    <span class="sr-only">Toggle sidebar</span>
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Logo -->
                <a href="/">
                    <i class="fas fa-file-alt text-indigo-600 text-2xl"></i>
                </a>

                <!-- User avatar button -->
                <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})" class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                        @if (auth()->check())
                            @if (auth()->user()->profile_picture)
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/storage/profile_pictures/' . auth()->user()->profile_picture) }}">
                            @else
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ asset('/images/anonymous.png') }}">                            
                            @endif
                        @endif
                        <span class="sr-only">User menu</span>
                    </button>                    
                    <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false" x-ref="userMenu"
                        tabindex="-1"
                        class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 top-10 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-label="user menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Left mini bar -->
            <nav aria-label="Options"
                class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-indigo-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl">
                <!-- Logo -->
                <div class="flex-shrink-0 py-4">
                    <a href="/">
                        <i class="fas fa-file-alt text-indigo-600 text-2xl"></i>
                    </a>
                </div>
                <div class="flex flex-col items-center flex-1 p-2 space-y-4">
                    <!-- Menu button -->
                    <button
                        @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                        class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                        <span class="sr-only">Toggle sidebar</span>
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>

                <!-- User avatar -->
                <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})" class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                        @if (auth()->check())
                            @if (auth()->user()->profile_picture)
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/storage/profile_pictures/' . auth()->user()->profile_picture) }}">
                            @else
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ asset('/images/anonymous.png') }}">                            
                            @endif
                        @endif
                        <span class="sr-only">User menu</span>
                    </button>
                    <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false" x-ref="userMenu"
                        tabindex="-1"
                        class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-label="user menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </a>
                    </div>
                </div>
            </nav>

            <div x-transition:enter="transform transition-transform duration-300"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition-transform duration-300"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-show="isSidebarOpen"
                class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-64 bg-white border-r-2 border-indigo-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64">
                <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="flex items-center justify-center flex-shrink-0 py-10">
                        <a href="#" class="font-bold text-xl text-indigo-600">
                            <i class="fas fa-file-alt text-indigo-600 text-xl"></i> POSTIFY
                        </a>
                    </div>

                    <!-- Links -->
                    <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
                        <a href="{{route('posts.dashboard')}}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600">
                            <span aria-hidden="true" class="p-2 transition-colors rounded-lg  group-hover:text-white">
                                <i class="fas fa-tachometer-alt group-hover:text-white"></i>
                            </span>
                            <span class="text-black group-hover:text-white">Dashboard</span>
                        </a>
                        <a href="{{ route('posts.index') }}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600">
                            <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:text-white">
                                <i class="fas fa-pencil-alt group-hover:text-white"></i>
                            </span>
                            <span class="text-black group-hover:text-white">Posts</span>
                        </a>                    
                        <a href="{{route('saved-posts.index')}}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600">
                            <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:text-white">
                                <i class="fa-solid fa-bookmark group-hover:text-white"></i>
                            </span>
                            <span class="text-black group-hover:text-white">Saved Posts</span>
                        </a>                    
                        <a href="{{route('liked-posts.index')}}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600">
                            <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:text-white">
                                <i class="fas fa-heart group-hover:text-white"></i>
                            </span>
                            <span class="text-black group-hover:text-white">Liked Posts</span>
                        </a>                    
                    </div>
                </nav>
            </div>
        </div>

        <div class="flex flex-col w-full mt-[100px]">