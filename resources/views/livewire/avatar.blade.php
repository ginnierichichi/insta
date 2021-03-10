<div>
    <form wire:submit.prevent="save">
        @if($avatar)
            <div wire:ignore
                x-data="{
                    setup() {
                            const cropper = new Cropper(document.getElementById('avatar'), {
                                aspectRatio: 1/1,
                                autoCropArea: 1,
                                viewMode: 1,
                                crop (event) {
                                    @this.set('x', event.detail.x)
                                    @this.set('x', event.detail.y)
                                    @this.set('x', event.detail.width)
                                    @this.set('x', event.detail.height)
                                }
                            })
                        }
                }"
                x-init="setUp">
                <div class="mb-2">
                    <img src="{{ $avatar->temporaryUrl() }}" id="avatar">
                </div>
                <button type="submit">Upload</button>
            </div>
        @else
            <label for="avatar">
                <img src="{{ auth()->user()->avatar() }}" >
            </label>
            <input type="file" name="avatar" id="avatar" wire:model="avatar">
        @endif
    </form>
</div>
