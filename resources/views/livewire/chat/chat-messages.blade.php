<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @foreach($messages as $message)
        <div>
            {{ $message->body }} {{ $message->user->present()->name }}
        </div>
    @endforeach
</div>
