<div class="relative mt-3">
    <div class="flex items-center">
        <x-input.text type="text" wire:model.debounce.duration.500ms="search" placeholder="&#xf002;  Search...." />
    </div>
    <div class="absolute bg-white border text-sm shadow-xl rounded w-72 mt-4 ">
        <ul>
            @foreach ($contacts as $contact)
            <li class="border-b border-gray-300">
                <x-button.link href="#" class=" text-left block hover:bg-gray-100 w-full p-3">{{ $contact->name }}</x-button.link>
            </li>
            @endforeach
            <li class="border-b border-gray-300">
                <a href="#" class="block hover:bg-gray-100 p-3">TeddyBear</a>
            </li>
            <li class="border-b border-gray-300">
                <a href="#" class="block hover:bg-gray-100 p-3">TeddyBear</a>
            </li>
        </ul>
    </div>
</div>
