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
