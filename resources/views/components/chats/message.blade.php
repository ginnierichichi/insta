@props ([
    'message',
    'align' => 'justify-start',
    'colour' => 'bg-blue-200'
])

<div class="flex mb-2 {{ $align }}">
    <div>
        <img src="{{asset($message->user->present()->avatar() ? 'avatars/'.$message->user->present()->avatar() : '/images/default.png') }}" class="w-10 h-10 rounded-full" />
    </div>
    <div>
        <div>
            {{ $message->user->present()->name() }}
        </div>
        <div class="{{ $colour }} p-2 rounded-lg">
            {{ $message->body }}
        </div>
    </div>
    {{--            {{ $message->body }} {{ $message->user->present()->name }}--}}
</div>
