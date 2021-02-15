<div>
    <div class="grid grid-cols-4 gap-4 pt-4 flex justify-center">
        <div class="grid-cols-1 "></div>
        <div class="col-span-2 border">
            <div class="bg-white shadow-lg rounded-lg"><img src="{{ asset('images/stories.png') }}"></div>
            <div class=" rounded-lg mt-10 text-lg">
                @forelse($posts as $post)
                    <div class="my-4 bg-white shadow-lg rounded-lg">
                        <a href="{{ route('profile', $post->user) }}" >
                            <div class="flex items-center pl-8 py-4 border">
                                <img src=" {{$post->user->avatar ? asset('avatars/'.$post->user->avatar) : asset('images/default.png') }}" class=" rounded-full w-16 h-16">
                                @dd($post->name)
                                <div class="pl-4 text-2xl"><strong>{{ $post->user->name }}</strong></div>
                                @dd($posts)
                            </div>
                        </a>
                        <div>
                            <img src="{{ asset('/posts/'.$post->image) }}">
                        </div>
                        <div class="border pl-8 py-4">
                            <div class="space-x-4">
                                <i class="far fa-heart text-4xl"></i>
                                <i class="far fa-comment text-4xl fa-rotate-180"></i>
                                <i class="far fa-paper-plane text-4xl"></i>
                            </div>
                            <div>
                                <div><strong>21 likes</strong></div>
                            </div>
                        </div>
                        <div class="border py-4 pl-8">
                            <div class="flex items-center space-x-6">
                                <div><strong>{{ $post->user->username }}</strong></div>
                                <div>{{ $post->caption }}</div>
                            </div>
                            <div class="text-gray-600 text-sm pt-4">
                                7 HOURS AGO
                            </div>
                        </div>
                        <div class="border p-8">
                            <livewire:comments-section />
                        </div>
                    </div>
                    @empty
                    Nothing in NewsFeed
                @endforelse
            </div>
        </div>
        <div class=" grid-cols-1 border space-x-8 space-y-8">
           @livewire('friends-list')
        </div>
    </div>
</div>
