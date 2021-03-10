<div class="pt-1">
    <div>
        <div class="w-1/2">
            <x-input.text />
        </div>
        <div>Creating new chats goes here</div>
    </div>
    @if($chats->count())
        @foreach($chats as $chat)
            <div wire:key="{{ $chat->uuid }}" >
                <a href="{{ route('chat', ['user' => auth()->user()->username, 'chat' => $chat->uuid]) }}" class="block p-4 mb-2 bg-white rounded-lg">
                    <div class="font-semibold">
                        @foreach($chat->users as $user)
                            {{ $user->present()->name() }}{{ $loop->last ? null : ','  }}
                        @endforeach
                    </div>
                    <p class="flex items-center">
{{--                        @dd(optional($chat->pivot)->read_at)--}}
                        @if(!optional($chat->pivot)->read_at)
{{--                        @dd($chat->messages->last()->body)--}}
                            <span class="bg-insta mr-2 rounded-full w-2 h-2"></span>
                        @endif
                           <span>{{ $chat->messages->last()->body ?? "" }}</span>
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
