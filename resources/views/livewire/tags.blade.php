<div>
    <div class="grid grid-cols-4 gap-4 pt-4 flex justify-center">
        <div class="grid-cols-1 "></div>
        <div class="col-span-2 border">
            <div class=" rounded-lg mt-10 text-lg">
                @forelse($taggedPosts as $feed)
                    <div>
                        @dd($feed->posts->first)
                        <img src="{{ asset('/posts/'.$feed->image) }}" />
                    </div>
                @empty
                    Nothing in NewsFeed
                @endforelse
            </div>
        </div>
    </div>
</div>
