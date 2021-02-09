@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-8">
        <div class="text-4xl text-center">
            {{ $title }}
        </div>

        <div class="mt-8 text-xl">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-right">
        {{ $footer }}
    </div>
</x-modal>

