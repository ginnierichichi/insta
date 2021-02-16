{{-- The best athlete wants his opponent at his best. --}}
<div class="container">
    <div class="gallery">
        @forelse($user->posts as $post)
            <x-button.link class="gallery-item" tabindex="0" wire:click="viewPost({{ $post->id }})" wire:key="{{ $post->id }}" >
                <img src="{{ asset('/posts/'.$post->image) }}"
                     class="gallery-image" alt="">
                <div class="gallery-item-info">
                    <ul>
                        <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span>
                            <i
                                class="fas fa-heart"> </i>
                            {{ $post->likes->count() }}
                        </li>
                        <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                class="fas fa-comment" aria-hidden="true"></i> 2
                        </li>
                    </ul>
                </div>
            </x-button.link>
        @empty
            <div class="text-center p-10 text-xl">
                {{--                            <x-gallery />--}}  No posts yet...
            </div>
        @endforelse
    </div>
</div>

