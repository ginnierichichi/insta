{{-- If your happiness depends on money, you will never be happy with yourself. --}}
<form action="#" wire:submit.prevent="reply">
    <div>
        <textarea class="w-full" wire:model="body"></textarea>
        <div class="flex justify-end">
            <x-button.primary>Send</x-button.primary> <!-- trigger event and update livewire component. -->
        </div>
    </div>
</form>

