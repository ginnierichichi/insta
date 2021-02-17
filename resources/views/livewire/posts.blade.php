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
                                class="fas fa-comment" aria-hidden="true"></i>
                            {{ $post->comments->count() ?: 0 }}
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


<!-------- Create Posts Modal -------------->
<x-modal.dialog wire:model.defer="showCreateModal">
    <x-slot name="title">Create a Post</x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4 pt-4">
            <div>
                <div>Photo:</div>
                <x-input.filepond type="file" wire:model="selectedPost.image" id="post.image" />
            </div>

            <div>
                <div>Description:</div>
                <x-input.textarea wire:model.defer="selectedPost.description" id="post.description" placeholder="write your thoughts here" />
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-button.secondary>Cancel</x-button.secondary>
        <x-button.secondary wire:click="newPost">Save</x-button.secondary>
    </x-slot>
</x-modal.dialog>

<!-------- View a Post Modal -------------->
<div>
    @if($showPostModal)
        <x-modal.dialog wire:model.defer="showPostModal">
            <x-slot name="title">Create a Post</x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-3 gap-4 pt-4">
                    <div class="col-span-2">
                        <img src="{{ asset('/posts/'.$selectedPost->image) }}" class="rounded-lg shadow-lg">
                    </div>
                    <div class="space-y-2">
                        <div ><strong>{{ $user->name }}</strong></div>
                        <div >{{ $selectedPost->caption }}</div>
                        <div class="flex items-center space-x-2 pt-4">
                            <x-button.link wire:click="toggleLike" type="submit"><i class="far fa-heart text-xl {{ $like ? 'fas fa-heart text-red-600 text-xl' : '' }}"></i></x-button.link>
                            {{--                                @dd($selectedPost->likes)--}}
                            <div class="text-xl">{{ $selectedPost->likes->count() ?: 0 }}</div>
                            <div class="pl-2"><i class="far fa-comment text-xl"></i> comments</div>
                        </div>
                        <div class="pt-4">
                            {{--                                <div>{{ $selectPost->comments->content }}</div>--}}
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary>Cancel</x-button.secondary>
                <x-button.secondary type="submit">Save</x-button.secondary>
            </x-slot>
        </x-modal.dialog>
    @endif
</div>

