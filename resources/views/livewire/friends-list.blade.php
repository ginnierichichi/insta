<div class="space-y-4 pl-4">
    <a href="{{ route('profile', ['user' => auth()->user()->username ]) }}" class="pt-4 flex items-center">
        <img src="{{ asset('avatars/'.auth()->user()->avatar) }}" class="w-16 h-16 rounded-full">
        <div class="pl-4">
            <div><strong>{{ auth()->user()->username }}</strong></div>
            <div class="text-gray-600">{{ auth()->user()->name }}</div>
        </div>
    </a>
    <div class="pt-4 lg:pt-10">Suggestions For you</div>
    @foreach ($users as $user)
        @if(!auth()->user()->isFollowing($user))
            <li class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="pr-1">
                        <img src=" {{$user->avatar ? asset('avatars/'.$user->avatar) : asset('images/default.png') }}" class=" rounded-full w-10 h-10">
                    </div>
                    <div>{{ $user->name }}</div>
                </div>
                <x-button.link wire:click="followUser({{ $user->id }})">
                    <div class="text-insta pr-4">follow</div>
                </x-button.link>
            </li>
        @endif
    @endforeach

    <div class="pt-4">Following</div>
    <ul>
        @foreach (auth()->user()->following()->get() as $user)
            <li class="pb-4 flex items-center justify-between space-x-2">
                <div class="pr-1 flex items-center">
                    <img src=" {{$user->avatar ? asset('avatars/'.$user->avatar) : asset('images/default.png') }}" class=" rounded-full w-10 h-10">
                    <span >{{ $user->name }}</span>
                </div>
                <x-button.link wire:click="followUser({{ $user->id }})">
                    <div class="text-insta pr-4">unfollow</div>
                </x-button.link>
            </li>
        @endforeach
    </ul>
</div>
