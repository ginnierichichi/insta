<div>
    <div class="grid grid-cols-4 gap-4 pt-4 flex justify-center">
        <div class="grid-cols-1 "></div>
        <div class="col-span-2">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="flex items-center p-4">
                    @foreach (auth()->user()->following()->get() as $user)
                        <div class="space-x-6">
                            <div class="pr-1">
                                <img src=" {{$user->avatar ? asset('avatars/'.$user->avatar) : asset('images/default.png') }}" class=" rounded-full w-20 h-20">
                                <div class="flex justify-center">{{ $user->username }}</div>
                            </div>
                        </div>
                    @endforeach

{{--                    <img src="{{ asset('images/stories.png') }}">--}}
                </div>
            </div>
            <div class="rounded-lg mt-10 text-lg">
                @forelse($posts as $post)
                    <div class="my-4 bg-white shadow-lg rounded-lg">
                        <a href="{{ route('profile', $post->user) }}" >
                            <div class="flex items-center pl-8 py-4">
                                <img src=" {{$post->user->avatar ? asset('avatars/'.$post->user->avatar) : asset('images/default.png') }}" class=" rounded-full w-16 h-16">
                                <div class="pl-4 text-2xl"><strong>{{ $post->user->name }}</strong></div>
                            </div>
                        </a>
                        <div>
                            <img src="{{ asset('/posts/'.$post->image) }}">
                        </div>
                        <div class="pl-8 py-4">
                            <div class="space-x-4">
                                <i class="far fa-heart text-4xl"></i>
                                <i class="far fa-comment text-4xl fa-rotate-180"></i>
                                <i class="far fa-paper-plane text-4xl"></i>
                            </div>
                            <div>
                                <div><strong>{{ $post->likes->count() }}</strong></div>
                            </div>
                        </div>
                        <div class="border-t py-4 pl-8">
                            <div class="flex items-center space-x-6">
                                <div><strong>{{ $post->user->username }}</strong></div>
                                <div>{{ $post->caption }}</div>
                            </div>
                            <div class="text-gray-600 text-sm pt-2">
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="border-t p-8">
                            <livewire:comments-section :post="$post" />
{{--                            @livewire('comments-section')--}}
                        </div>
                    </div>
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
