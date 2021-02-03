<div class="py-12">
    <!--------- Profile text ------------>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!----- Button to add an image ------>
            <div class="flex justify-end pt-6 pr-6">
                <x-button.link wire:click="create"> <i class="far fa-plus-square text-2xl text-gray-700 hover:text-insta"></i></x-button.link>
            </div>


{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
            <div class="grid grid-cols-3 gap-4 pt-4 border-b">
                <div class="pb-10 pl-20 flex justify-center items-center" :error="$errors->first('newAvatar')">
{{--                    <img src=" {{ auth()->user()->avatarUrl() }}" alt="Profile Photo" width="200px" class="rounded-full">--}}
                 <img src=" {{ asset('images/profile.jpg') }}" width="200px" class="rounded-full ring ring-pink-400 ring-offset-4 ring-offset-pink-100">
                </div>
                <div class="p-10 col-span-2" >
                    <div class="flex items-center space-x-4">
                        <h1>@ {{ $user->username }}</h1>

                        <x-button.primary class="text-xs" wire:click="edit">Edit Profile</x-button.primary>
                    </div>
                    <div class="flex items-center space-x-4 pt-4 text-sm">
                        <h2><strong>150</strong> posts</h2>
                        <h2><strong>20K</strong> followers</h2>
                        <h2><strong>1000</strong> following</h2>
                    </div>
                    <div class="pt-4">
                        <div><strong>{{ $user->profile->title }}</strong></div>
                        <p>{{ $user->profile->description }}</p>
                    </div>
                    <div><a href="#">{{ $user->profile->url }}</a></div>
                </div>

            </div>
<!------------ Buttons Section ----------->
            <div>
                <div></div>
                <div></div>
                <div></div>
            </div>

<!------------ Picture Section ----------->

            <div class="grid grid-cols-3 gap-4 px-4 pt-6 container">
                <div class="object-cover"> <img src=" {{ asset('images/sunflower.jpg') }}" ></div>
                <div> <img src=" {{ asset('images/kingfisher.jpg') }}" ></div>
                <div> <img src=" {{ asset('images/seeds.jpg') }}" ></div>
                <div> <img src=" {{ asset('images/purple.jpg') }}" ></div>
                <div> <img src=" {{ asset('images/marigold.jpg') }}" ></div>
                <div> <img src=" {{ asset('images/flower.jpg') }}"></div>
            </div>
        </div>
    </div>

    <!-------- Edit Profile Modal -------------->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">

            <x-slot name="title">Update Profile</x-slot>

            <x-slot name="content">
                <div class="space-y-4">
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
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-------- Create Posts Modal -------------->
    <x-modal.dialog wire:model.defer="showCreateModal">
        <x-slot name="title">Create a Post</x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4 pt-4">

                <x-input.group label="Photo" for="photo" :error="$errors->first('newPhoto')">
                    <x-input.filepond wire:model="newPhoto" />
                </x-input.group>

                <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                    <x-input.textarea wire:model="editing.description" id="description" placeholder="write your thoughts here" />
                </x-input.group>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button.secondary>Cancel</x-button.secondary>
            <x-button.primary>Save</x-button.primary>
        </x-slot>
    </x-modal.dialog>
</div>
