<div class="flex mb-2 justify-end">
    <div>
        <img src="{{ asset('avatars/' . $message->user->avatar) }}" class="w-10 h-10 rounded-full mr-4" />
    </div>
    <div>
        <div>
            {{ $message->user->name }}
        </div>
        <div class="bg-insta p-2 text-white rounded-lg">
            {{ $message->body }}
        </div>
    </div>
{{--                {{ $message->body }} {{ $message->user->present()->name }}--}}
</div>
