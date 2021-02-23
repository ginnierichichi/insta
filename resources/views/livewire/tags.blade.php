<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-20">
{{--    @dd($tags)--}}
    <div class="pb-6">Search results for #{{ $name }}</div>
    @forelse($discover as $feed)
        <div class="container">
            <div class="gallery">
                @foreach($feed->posts as $taggedPost)
                    <x-button.link class="gallery-item" tabindex="0" wire:click="viewPost({{ $taggedPost->id }})" wire:key="{{ $taggedPost->id }}" >
                        <img src="{{ asset('/posts/'.$taggedPost->image) }}"
                             class="gallery-image" alt="">
                        <div class="gallery-item-info">
                            <ul>
                                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span>
                                    <i
                                        class="fas fa-heart"> </i>
                                    {{ $taggedPost->likes->count() }}
                                </li>
                                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                        class="fas fa-comment" aria-hidden="true"></i>
                                    {{ $taggedPost->comments->count() ?: 0 }}
                                </li>
                            </ul>
                        </div>
                    </x-button.link>
                @endforeach

                @empty
                    <div class="text-center p-10 text-xl">
                        {{--                            <x-gallery />--}}  No posts yet...
                    </div>

            </div>
        </div>
    @endforelse
</div>
<div>
    @if($showPostModal)
        <x-modal.dialog wire:model.defer="showPostModal" class="max-w-7xl">
            <div class="grid grid-cols-3 gap-4 pt-4">
                <x-slot name="title"></x-slot>
                <x-slot name="content">
                    <div class="flex grid grid-cols-3">
                        <div class="col-span-2">
                            <img src="{{ asset('/posts/'.$selectedPost->image) }}" class="rounded-lg shadow-lg">
                        </div>
                        <div class="space-y-2 ml-8 text-base">
                            <div class="flex items-center border-b pb-4">
                                <div>
                                    @if($selectedPost->user->avatar)
                                        <img src=" {{ asset('avatars/'. $selectedPost->user->avatar) }}" class="rounded-full w-10 h-10 object-fit">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" class="rounded-full w-10 h-10 object-fit">
                                    @endif
                                </div>
                                <div class="pl-2"><strong>{{ $selectedPost->user->name }}</strong></div>
                            </div>
                            <div >{!! $selectedPost->caption !!} </div>
                            <div class="pt-4">Comments:</div>
                            <div class="overflow-scroll max-h-400 border-b">
                                @forelse($selectedPost->comments->sortDesc() as $comment)
                                    <div class="border-b text-xs">
                                        <div class="flex justify-between my-2">
                                            {{--                @dd($comment)--}}
                                            <p class="font-bold text-xs">{{ $comment->creator->name}}</p>
                                            <p class="mx-3 text-xs text-gray-500 font-semibold">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="text-gray-800 pb-1">{{ $comment->content }}</p>
                                    </div>
                                @empty
                                    <div class="text-base">No comments yet...</div>
                                @endforelse
                            </div>
                            <div class="">
                                <div class="flex items-center space-x-2 pt-4 pb-2 border-b pb-2">
                                    <x-button.link wire:click="toggleLike" type="submit"><i class="far fa-heart text-xl {{ $like ? 'fas fa-heart text-red-600 text-xl' : '' }}"></i></x-button.link>
                                    {{--                                @dd($selectedPost->likes)--}}
                                    <div><i class="far fa-comment text-xl"></i></div>
                                    <div><i class="far fa-paper-plane"></i>
                                </div>
                            </div>

                            <div class="text-sm">Liked by:
                                @if($like)
                                    {{ $selectedPost->likes->last()->user->username }}
                                        @if($selectedPost->likes->count() -1 > 0)
                                            and {{ $selectedPost->likes->count() -1 }} other
                                        @elseif($selectedPost->likes->count() -1 > 1)
                                            and {{ $selectedPost->likes->count() -1 }} others
                                        @endif
                                @endif
                            </div>
                            <div class="uppercase text-xs text-gray-600">{{ $selectedPost->created_at->diffforHumans() }}</div>
                        </div>
                    </div>
                    </div>
                </x-slot>
            </div>
            <x-slot name="footer">
                <x-button.secondary>Cancel</x-button.secondary>
            </x-slot>
        </x-modal.dialog>
    @endif
</div>
