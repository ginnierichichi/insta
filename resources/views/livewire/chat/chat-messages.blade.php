<div>
    This is where the messages will go
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @foreach($messages as $message)
        @if($message->isOwn())
            <livewire:chat.my-message :message="$message" wire:key="{{ $message->id }}" />
        @else
            <livewire:chat.other-message :message="$message" wire:key="{{ $message->id }}" />
        @endif
    @endforeach
</div>
