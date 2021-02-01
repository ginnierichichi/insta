<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="grid grid-cols-3 gap-4 pt-10 border-b">
        <div class="p-10 pl-20 flex justify-center items-center">
            <img src=" {{ asset('images/profile.jpg') }}" width="200px" class="rounded-full">
        </div>
        <div class="p-10 col-span-2" >
            <div class="flex items-center space-x-4">
                <h1>@ {{ auth()->user()->username }}</h1>

                <button class="rounded-lg bg-blue-400 px-4 py-2">Follow</button>
            </div>
            <div class="flex items-center space-x-4 pt-4 text-sm">
                <h2><strong>150</strong> posts</h2>
                <h2><strong>20K</strong> followers</h2>
                <h2><strong>1000</strong> following</h2>
            </div>
            <div class="pt-2">
                <p>Hi guys! Im a junior software dev with a love for photography and nature.<br>
                    I hope you like my work!
                </p>
            </div>
            <div></div>
        </div>
    </div>

<!------------ Picture Section ----------->

    <div class="grid grid-cols-3 gap-4 px-4 pt-6">
        <div> <img src=" {{ asset('images/sunflower.jpg') }}" width="500px"></div>
        <div> <img src=" {{ asset('images/kingfisher.jpg') }}" width="500px" ></div>
        <div> <img src=" {{ asset('images/seeds.jpg') }}" width="500px" ></div>
    </div>
</div>
        </div>
    </div>
</div>
