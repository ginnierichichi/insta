<div class="pt-1">
    {{-- Be like water. --}}
    @if($chats->count())
        @foreach($chats as $chat)
            <a href="{{ route('chat', ['user' => 'name', 'message' => $chat->uuid]) }}" class="block p-4 mb-2 bg-white rounded-lg">
                <div class="font-semibold">
                    @foreach($chat->users as $user)
                        {{ $user->present()->name() }}{{ $loop->last ? null : ','  }}
                    @endforeach
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
