<div >
    <form wire:submit.prevent="addComment" method="POST" class="col-span-4">
        @csrf
        <div class="flex items-center grid grid-cols-5 w-full">
            <div class="col-span-4 flex items-center space-x-2 w-full">
                <svg aria-label="Emoji" class="_8-yf5 " fill="#262626" height="40" viewBox="0 0 48 48" width="40"><path d="M24 48C10.8 48 0 37.2 0 24S10.8 0 24 0s24 10.8 24 24-10.8 24-24 24zm0-45C12.4 3 3 12.4 3 24s9.4 21 21 21 21-9.4 21-21S35.6 3 24 3z"></path><path d="M34.9 24c0-1.4-1.1-2.5-2.5-2.5s-2.5 1.1-2.5 2.5 1.1 2.5 2.5 2.5 2.5-1.1 2.5-2.5zm-21.8 0c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5-1.1 2.5-2.5 2.5-2.5-1.1-2.5-2.5zM24 37.3c-5.2 0-8-3.5-8.2-3.7-.5-.6-.4-1.6.2-2.1.6-.5 1.6-.4 2.1.2.1.1 2.1 2.5 5.8 2.5 3.7 0 5.8-2.5 5.8-2.5.5-.6 1.5-.7 2.1-.2.6.5.7 1.5.2 2.1 0 .2-2.8 3.7-8 3.7z"></path></svg>
                <div class="w-full col-span-4 border-none shadow-none bg-none border-white">
                    <x-input.text wire:model.lazy="newComment" class="col-span-4 w-full" placeholder="Add a comment..."  :error="$errors->first('newComment')"/>
                </div>
            </div>
            <div class="flex justify-end opacity-50 text-insta text-xl w-full">
                <x-button.link type="submit" class="text-xl tracking-wider"><strong>Post</strong></x-button.link>
            </div>
        </div>
    </form>

    @foreach($post->comments->sortDesc() as $comment)
        <div class="rounded-lg border shadow py-1 px-3 my-2 text-xs">
            <div class="flex justify-between my-2">
{{--                @dd($comment)--}}
                <p class="font-bold text-xs">{{ $comment->user_id }}</p>
                <p class="mx-3 text-xs text-gray-500 font-semibold">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            <p class="text-gray-800 pb-1">{{ $comment->content }}</p>
        </div>
    @endforeach
</div>
