<div>
    <div class="grid grid-cols-4 gap-4 pt-4 flex justify-center">
        <div class="grid-cols-1 border border-red-500 ">1</div>
        <div class="col-span-2 border">
            <div class="bg-white shadow-lg rounded-lg"><img src="{{ asset('images/stories.png') }}"></div>
            <div class=" rounded-lg mt-10">
                @foreach($posts as $post)
                    <div class="my-4 bg-white shadow-lg rounded-lg">
                        <div class="flex items-center p-8 border">
                            <img src=" {{$post->avatar ? asset('avatars/'.$post->avatar) : asset('images/default.png') }}" class=" rounded-full w-10 h-10">
                            <div class="pl-4">{{ $post->name }}</div>
                        </div>
                        <div>
                            <img src="{{ asset('images/forgetme.jpg') }}">
                        </div>
                        <div class="border p-6">LIKES</div>
                        <div class="border p-20"></div>
                        <div class="border p-8">ADD COMMENT</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class=" grid-cols-1 border">
            <div>Account</div>

            <div>Suggestions For you</div>
        </div>
    </div>
</div>
