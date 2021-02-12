<div class="relative">
    <div class="flex items-center">
        <x-input.text type="text" wire:model.debounce.duration.500ms="search" placeholder="&#xf002;  Search...." />
    </div>

    @if($search)
    <div class="absolute bg-white border text-sm shadow-xl rounded w-72 mt-4 ">
        <ul>
            @forelse ($contacts as $contact)
            <li class="border-b border-gray-300">
                <a href="{{ route('profile', $contact->username) }}"
                               class="text-left block hover:bg-gray-100 w-full p-3">
                    <div class="flex items-center">
                        <img src=" {{$contact->avatar ? asset('avatars/'.$contact->avatar) : asset('images/default.png') }}" class=" rounded-full w-10 h-10">
                        <div class="pl-4">{{ $contact->name }}</div>
                    </div>
                </a>
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
