<div class="space-y-4 pl-4">
    <button class=" pt-4 flex items-center">
        <img src="{{ asset('avatars/'.auth()->user()->avatar) }}" class="w-16 h-16 rounded-full">
        <div class="pl-4">
            <div><strong>{{ auth()->user()->username }}</strong></div>
            <div class="text-gray-600">{{ auth()->user()->name }}</div>
        </div>
    </button>
    <div >Suggestions For you</div>

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

