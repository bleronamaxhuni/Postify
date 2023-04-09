<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </form>

                @if ($user->profile_picture)
                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/storage/profile_pictures/' . $user->profile_picture) }}">
                <form method="POST" action="{{ route('profile.delete-picture') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                @elseif($user->profile_picture == NULL)
                    <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" src="{{ url('/images/anonymous.png') }}">
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

