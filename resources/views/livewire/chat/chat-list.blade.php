<div class="pt-1">
    @if($chats->count())
        @foreach($chats as $chat)
            <div wire:key="{{ $chat->uuid }}" >
                <a href="{{ route('chat', ['user' => auth()->user()->username, 'chat' => $chat->uuid]) }}" class="block p-4 mb-2 bg-white rounded-lg">
                    <div class="font-semibold">
                        @foreach($chat->users as $user)
                            {{ $user->present()->name() }}{{ $loop->last ? null : ','  }}
                        @endforeach
                    </div>
                    <p>
                        <span>This is the body of the last message sent</span>
                    </p>
                </a>
            </div>
        @endforeach
    @else
        <p>No conversations yet</p>
    @endif
</div>

{{--<div class="pt-1">--}}
{{--    @if($chats->count())--}}
{{--        @foreach($chats as $chat)--}}
{{--            <div wire:key="{{ $chat->id }}">--}}
{{--                <div>--}}
{{--                    <div class="font-semibold">--}}
{{--                        @foreach($chat->users as $user)--}}
{{--                            <a href="{{ route('chat', ['user' => $user->username, 'message' => $chat->uuid]) }}" class="block p-4 mb-2 bg-white rounded-lg">--}}
{{--                                {{ $user->present()->name() }}{{ $loop->last ? null : ','  }}--}}
{{--                            </a>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                    <p>--}}
{{--                        <span>This is the body of the last message sent</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    @else--}}
{{--        <p>No conversations yet</p>--}}
{{--    @endif--}}
{{--</div>--}}
