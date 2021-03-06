<div class="my-4 bg-white shadow-lg rounded-lg">
    <a href="{{ route('profile', $post->user) }}" >
        <div class="flex items-center pl-8 py-4">
            <img src=" {{$post->user->avatar ? asset('avatars/'.$post->user->avatar) : asset('images/default.png') }}" class=" rounded-full w-16 h-16">
            <div class="pl-4 text-2xl"><strong>{{ $post->user->name }}</strong></div>
        </div>
    </a>
    <div>
        <img src="{{ asset('/posts/'.$post->image) }}">
    </div>
    <div class="pl-8 py-4">
        <div class="space-x-4">
            {{--                                @dd($post->likes->first())--}}
            <x-button.link wire:click="toggleLike" type="submit"><i class="far fa-heart text-4xl {{ $like ? 'fas fa-heart text-red-600 text-4xl' : '' }}"></i> </x-button.link>
            <i class="far fa-comment text-4xl fa-rotate-180"></i>
            <i class="far fa-paper-plane text-4xl"></i>
        </div>
        <div class="text-sm">Liked by:
            {{--                                @dd($post->likes)--}}

            {{ $likedBy }} and {{ $likesCount }} {{ $likesCount > 0 ? 'other' : 'others' }}

{{--            @if($post->likes)--}}
{{--                {{ $likedBy }}--}}
{{--                @if($post->likes->count() -1 > 0)--}}
{{--                    and {{ $post->likes->count() -1 }} other--}}
{{--                @elseif($post->likes->count() -1 > 1)--}}
{{--                    and {{ $post->likes->count() -1 }} others--}}
{{--                @endif--}}
{{--            @endif--}}
        </div>
    </div>
    <div class="border-t py-4 pl-8">
        <div class="flex items-center space-x-6">
            <div><strong>{{ $post->user->username }}</strong></div>
            <div>{!! $post->caption  !!} </div>
        </div>
        <div class="text-gray-600 text-sm pt-2">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="border-t p-8">
        <livewire:comments-section :post="$post" />
        {{--                            @livewire('comments-section')--}}
    </div>
</div>
