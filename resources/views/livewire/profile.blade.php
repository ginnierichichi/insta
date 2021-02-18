<div class="py-12">
    <!--------- Profile text ------------>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!----- Button to add an image ------>
            <div class="flex justify-end pt-6 pr-6">
                @if($user->id === auth()->id())
                    <x-button.link wire:click="create">
                        <i class="far fa-plus-square text-2xl text-gray-700 hover:text-insta"></i>
                    </x-button.link>
                @endif
            </div>
            <x-button.link wire:click="dispatchEvent" >
                {{ __('Dispatch Event') }}
            </x-button.link>

{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
            <div class="grid grid-cols-3 gap-4 pt-4 border-b">
                <div class="pb-10 pl-20 flex justify-center items-center" :error="$errors->first('newAvatar')">
{{--                    <img src=" {{ auth()->user()->avatarUrl() }}" alt="Profile Photo" width="200px" class="rounded-full">--}}
                    @if($user->avatar)
                        <img src=" {{ asset('avatars/'. $user->avatar) }}" class="rounded-full ring ring-pink-400 ring-offset-4 ring-offset-pink-100 w-52 h-52 object-fit">
                    @else
                        <img src="{{ asset('images/default.png') }}">
                    @endif
                </div>

                <div class="p-10 col-span-2" >
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <h1>@ {{ $user->username }}</h1>
                            <img src="https://img.icons8.com/color/48/000000/instagram-verification-badge.png" width="20px"/>
                        </div>
                    @auth
                        @if($user->id === auth()->id())
                            <x-button.primary class="text-xs" wire:click="edit({{ $user->profile->id }})">Edit Profile</x-button.primary>
                        @elseif(auth()->user()->isFollowing($user))
                            <div class="space-x-1 pl-6">
                                <x-button.secondary class="text-xs">Message</x-button.secondary>
                                <x-button.secondary class="text-xs" wire:click="followUser({{ $user->id }})"><i class="fas fa-user-check"></i></x-button.secondary>
                                <x-button.secondary class="text-xs"><i class="fas fa-sort-down"></i></x-button.secondary>
                                <x-button.link class="text-xs"><i class="fas fa-ellipsis-h"></i></x-button.link>
                            </div>
                        @else
                            <x-button.primary class="text-xs" wire:click="followUser({{ $user->id }})">Follow</x-button.primary>
                        @endif
                    @endauth
                    </div>

                    <div class="flex items-center space-x-4 pt-4 text-sm">
                        <h2><strong></strong>{{ $user->posts->count() }} posts</h2>
                        <h2><strong>{{ $user->followers()->count() }}</strong> followers</h2>
                        <h2><strong></strong> {{ $user->following()->count() }} following</h2>
                    </div>
                    <div class="pt-4">
                        <div><strong>{{ $user->profile->title }}</strong></div>
                        <p>{{ $user->profile->description }}</p>
                    </div>
                    <div><a href="#">{{ $user->profile->url }}</a></div>
                </div>

            </div>
<!------------ Buttons Section for posts & tagged posts----------->

            <div class=" flex items-center justify-center space-x-8 pb-4">
                <div >
                    @auth
                    <x-jet-nav-link href="{{ route('profile', ['user' => auth()->user()->id ]) }}" :active="request()->routeIs('profile')">
                        <div class="flex items-center space-x-2 pt-4">
                            <i class="fab fa-buromobelexperte"></i>
                            <span>POSTS</span>
                        </div>
                    </x-jet-nav-link>
                    @endauth
                </div>
                <div>
                    <x-jet-nav-link href="#" :active="request()->routeIs('igtv')">
                        <div class="flex items-center space-x-2 pt-4">
                            <i class="fab fa-buromobelexperte"></i>
                            <span>IGTV</span>
                        </div>
                    </x-jet-nav-link>
                </div>
                <div>
                    <x-jet-nav-link href="#" :active="request()->routeIs('saved')">
                        <div class="flex items-center space-x-2 pt-4">
                            <i class="far fa-bookmark"></i>
                            <span>SAVED</span>
                        </div>
                    </x-jet-nav-link>
                </div>
                <div>
                    <x-jet-nav-link href="#" :active="request()->routeIs('tagged')">
                        <div class="flex items-center space-x-1 pt-4">
                            <i class="fas fa-user-tag"></i>
                            <span>TAGGED</span>
                        </div>
                    </x-jet-nav-link>
                </div>
            </div>

<!------------ Picture Section ----------->
<! ----- This will be in a foreach loop & each image when you hover over it will show the number of likes and no. of comments.
            When clicked on it will bring up a pop up modal of the image, description, likes & a comments section
            Default images for now to save on errors! ---------->
{{--            <div class="grid grid-cols-3 gap-4 px-4 py-4 container flex-col ">--}}
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

            <!-- End of container -->
            </div>
        </div>
{{--    </div>--}}

    <!-------- Edit Profile Modal -------------->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">

            <x-slot name="title">Update Profile</x-slot>

            <x-slot name="content">
                <div class="space-y-8">
                    <x-input.group for="title" label="Name" :error="$errors->first('editing.title')">
                        <x-input.text wire:model="editing.title" id="title" placeholder="Name" />
                    </x-input.group>

                    <x-input.group for="description" label="Bio" :error="$errors->first('editing.amount')">
                        <x-input.textarea wire:model="editing.description" id="bio" placeholder="Bio" />
                    </x-input.group>

                    <x-input.group label="Display Picture" for="avatar" :error="$errors->first('newAvatar')">
                        <x-input.filepond type="file" wire:model="newAvatar" id="avatar" />
                    </x-input.group>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>
                <x-button.secondary type="submit">Save</x-button.secondary>
            </x-slot>
        </x-modal.dialog>
    </form>
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
                            <div class="flex items-center space-x-2 pt-4 pb-2 border-b">
                                <x-button.link wire:click="toggleLike" type="submit"><i class="far fa-heart text-xl {{ $like ? 'fas fa-heart text-red-600 text-xl' : '' }}"></i></x-button.link>
                                {{--                                @dd($selectedPost->likes)--}}
                                <div class="text-xl">{{ $selectedPost->likes->count() ?: 0 }}</div>
                                <div class="pl-2"><i class="far fa-comment text-xl"></i> {{ $selectedPost->comments->count() ?:0 }}</div>
                            </div>
                            <div class="pt-4">Comments:</div>
                            <div class="overflow-scroll max-h-400">
                                    <div class="rounded-lg border py-1 px-3 my-2 text-xs">
                                        @foreach($selectedPost->comments->sortDesc() as $comment)
                                            <div class="border-b">
                                                <div class="flex justify-between my-2">
                                                    {{--                @dd($comment)--}}
                                                    <p class="font-bold text-xs">{{ $comment->user_id }}</p>
                                                    <p class="mx-3 text-xs text-gray-500 font-semibold">{{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                                <p class="text-gray-800 pb-1">{{ $comment->content }}</p>
                                            </div>
                                        @endforeach
                                    </div>
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

</div>



