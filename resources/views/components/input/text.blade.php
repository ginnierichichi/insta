@props(['leadingAddOn' => false])

<div class="max-w-lg flex rounded-md shadow-sm border space-y-4 text-gray-800 ">
    @if($leadingAddOn)
    <span class="inline-flex items-center px-3 py-4 rounded-l-md border border-r-0 rounded-lg border-gray-500 bg-gray-50 text-gray-800 sm:text-sm">
        {{$leadingAddOn}}
    </span>
    @endif
    <input
        {{$attributes}}
        class="{{ $leadingAddOn ? ' rounded-r-md' : '' }} flex-1 form-input p-2 fas block w-full rounded-md transition duration-150 ease-in-out sm:text-md sm:leading-5" />
</div>

