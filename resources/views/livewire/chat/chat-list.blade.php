<div class="pt-1">
    {{-- Be like water. --}}
    @if($chats->count())
        @foreach($chats as $chat)
            <a href="#" class="block p-4 mb-2 bg-white rounded-lg">
                <div>
                    <span class="font-semibold">Me and Jo</span>
                </div>
                <p>
                    <span>This is the body of the last message sent</span>
                </p>
            </a>
        @endforeach
    @else
        <p>No conversations yet</p>
    @endif

</div>
