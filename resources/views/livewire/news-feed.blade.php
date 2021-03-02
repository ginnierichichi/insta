<div>
    <div class="grid grid-cols-4 gap-4 pt-4 flex justify-center">
        <div class="grid-cols-1 ">
        </div>
        <div class="col-span-2">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="flex items-center pt-4 px-4">
                    @foreach (auth()->user()->following()->get() as $user)
                        <div class="space-x-6">
                            <a class="pr-1" href="{{ route('profile', $user->username) }}">
                                <img src=" {{$user->avatar ? asset('avatars/'.$user->avatar) : asset('images/default.png') }}" class=" rounded-full w-20 h-20">
                                <div class="flex justify-center">{{ $user->username }}</div>
                            </a>
                        </div>
                    @endforeach

{{--                    <img src="{{ asset('images/stories.png') }}">--}}
                </div>
            </div>
            <div class="rounded-lg mt-10 text-lg">
                @forelse($posts as $post)
                    <livewire:feed-component :post="$post"/>
                    @empty
                    Nothing in NewsFeed
                @endforelse
            </div>
        </div>
        <div class=" grid-cols-1 w-1/2 space-x-8 space-y-8">
           @livewire('friends-list')
        </div>
    </div>
</div>
