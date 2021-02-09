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


{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
            <div class="grid grid-cols-3 gap-4 pt-4 border-b">
                <div class="pb-10 pl-20 flex justify-center items-center" :error="$errors->first('newAvatar')">
{{--                    <img src=" {{ auth()->user()->avatarUrl() }}" alt="Profile Photo" width="200px" class="rounded-full">--}}
                    @if($user->avatar === auth()->user()->avatar)
                        <img src=" {{ asset('avatars/'.auth()->user()->avatar) }}" width="200px" class=" rounded-full ring ring-pink-400 ring-offset-4 ring-offset-pink-100 w-52 h-52 object-contain">
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
                    @if($user->id === auth()->id())
                        <x-button.primary class="text-xs" wire:click="edit({{ $user->profile->id }})">Edit Profile</x-button.primary>
                    @elseif(auth()->user()->isFollowing())
                        <div class="space-x-1 pl-6">
                            <x-button.secondary class="text-xs">Message</x-button.secondary>
                            <x-button.secondary class="text-xs" wire:click="followUser({{ $user->id }})"><i class="fas fa-user-check"></i></x-button.secondary>
                            <x-button.secondary class="text-xs"><i class="fas fa-sort-down"></i></x-button.secondary>
                            <x-button.link class="text-xs"><i class="fas fa-ellipsis-h"></i></x-button.link>
                        </div>
                    @else
                        <x-button.primary class="text-xs" wire:click="followUser({{ $user->id }})">Follow</x-button.primary>
                    @endif
                    </div>
                    <div class="flex items-center space-x-4 pt-4 text-sm">
                        <h2><strong>150</strong>{{ $user->posts->count() }}</h2>
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
                    <x-jet-nav-link href="{{ route('profile', ['user' => auth()->user()->id ]) }}" :active="request()->routeIs('profile')">
                        <div class="flex items-center space-x-2 pt-4">
                            <i class="fab fa-buromobelexperte"></i>
                            <span>POSTS</span>
                        </div>
                    </x-jet-nav-link>
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
{{--            <x-gallery />--}}
                <!-- End of container -->

            <div class="container">
                <div class="gallery">
                    @forelse($user->posts as $post)
                    <div class="gallery-item" tabindex="0">
                            <img src="{{ asset('/posts/'.$post->image) }}"
                             class="gallery-image" alt="">
                        <div class="gallery-item-info">
                            <ul>
                                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i
                                        class="fas fa-heart" aria-hidden="true"></i> 56
                                </li>
                                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i
                                        class="fas fa-comment" aria-hidden="true"></i> 2
                                </li>
                            </ul>
                        </div>
                    </div>
                    @empty
                        <div class="text-center p-10 text-xl">
                            <x-gallery />
                        </div>
                    @endforelse
                </div>
            </div>


{{--                <div class="doc">--}}
{{--                    @forelse($user->posts as $post)--}}
{{--                        <div >--}}
{{--                            <img src="{{ asset('/posts/'.$post->image) }}" >--}}
{{--                            <div class="links">--}}
{{--                                <a href=""><i class="fa fa-heart"></i><span></span></a>--}}
{{--                                <a href=""><i class="fa fa-comment"></i><span></span></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                        <div class="text-center p-10 text-xl">--}}
{{--                            No Posts Yet...--}}
{{--                        </div>--}}
{{--                    @endforelse--}}
{{--                </div>--}}
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
                        <input type="file" wire:model="newAvatar" id="avatar">
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

                <x-input.group label="Photo" for="post.image" :error="$errors->first('post.image')">
                    <input type="file" wire:model="post.image" />
                </x-input.group>

                <x-input.group for="post.description" label="Description" :error="$errors->first('post.description')">
                    <x-input.textarea wire:model="post.description" id="post.description" placeholder="write your thoughts here" />
                </x-input.group>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button.secondary>Cancel</x-button.secondary>
            <x-button.primary wire:click="newPost">Save</x-button.primary>
        </x-slot>
    </x-modal.dialog>
</div>

