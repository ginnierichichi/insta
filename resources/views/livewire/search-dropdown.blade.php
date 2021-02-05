<div class="relative mt-3">
    <div class="flex items-center">
        @unless($selectedContact)
        <x-input.text type="text" wire:model.debounce.duration.500ms="search" placeholder="&#xf002;  Search...." />
        @else
            <div class="flex justify-between items-center">
                <div class="pr-6">{{ $selectedContact->name }}</div>
                <x-button.link wire:click="clearSelection"><i class="fas fa-times"></i></x-button.link>
            </div>
        @endunless
    </div>

    @if($search)
    <div class="absolute bg-white border text-sm shadow-xl rounded w-72 mt-4 ">
        <ul>
            @forelse ($contacts as $contact)
            <li class="border-b border-gray-300">
                <x-button.link wire:click="selectContact({{ $contact->id }})"
                               class="text-left block hover:bg-gray-100 w-full p-3">
                    {{ $contact->name }}
                </x-button.link>
            </li>
            @empty
                <li class="border-b border-gray-300">
                    <div class="p-4">No Users Found...</div>
                </li>
            @endforelse
        </ul>
    </div>
    @endif
</div>
