<div class="space-y-4 pl-4">
    <button class=" pt-4 flex items-center">
        <img src="{{ asset('avatars/'.auth()->user()->avatar) }}" class="w-16 h-16 rounded-full">
        <div class="pl-4">
            <div><strong>{{ auth()->user()->username }}</strong></div>
            <div class="text-gray-600">{{ auth()->user()->name }}</div>
        </div>
    </button>
    <div >Suggestions For you</div>
    @foreach (\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
{{--        @dd($user)--}}
        <li class="py-4 flex justify-between items-center w-1/2">
            <div class="flex items-center">
                <div class="pr-1">
                    <img src=" {{$user->avatar ? asset('avatars/'.$user->avatar) : asset('images/default.png') }}" class=" rounded-full w-10 h-10">
                </div>
                <div>{{ $user->name }}</div>
            </div>
            <x-button.link wire:click="followUser({{ $user->id }})">
                <div class="text-insta">follow</div>
            </x-button.link>
        </li>
    @endforeach

    <div>Following</div>
    <ul>
        @foreach (auth()->user()->following()->get() as $user)
        <li class="py-4 flex items-center">
            <div class="pr-1">
                <img src=" {{$user->avatar ? asset('avatars/'.$user->avatar) : asset('images/default.png') }}" class=" rounded-full w-10 h-10">
            </div>
            <span >{{ $user->name }}</span>
        </li>
        @endforeach
    </ul>
</div>

