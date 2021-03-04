<div class="border-b overflow-scroll h-full py-4 inside">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @foreach($messages as $message)
        @if($message->isOwn())
            <x-chats.message align="justify-end" colour="bg-insta" :message="$message" wire:key="{{ $message->id }}" />
        @else
            <x-chats.message :message="$message" wire:key="{{ $message->id }}" />
        @endif
    @endforeach
</div>
