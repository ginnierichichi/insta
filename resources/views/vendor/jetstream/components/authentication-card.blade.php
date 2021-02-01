<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="grid grid-cols-2 bg-gray-100 flex items-center space-x-8">
        <div class="flex justify-end"><img src=" {{ asset('images/registerimage.png') }}" width="500px"></div>

        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex items-center justify-center">
                <img src=" {{ asset('images/logofont.png') }}" width="200px">
            </div>
{{--          this needs to be ternary.--}}
            <div class="flex items-center justify-center pb-4"><strong>Sign up to see photos and videos from your friends</strong> </div>
            {{ $slot }}
        </div>
    </div>
</div>
