<div>
    <div class="grid grid-cols-3">
        <div>
            <livewire:chat.chat-list :chats="$chats" :messages="$messages"/>
        </div>
        <div class="col-span-2">
            This is the private message page
            <div class="bg-white">
                <div>
                    <livewire:chat.chat-users  />
                </div>
                <div>
                    <livewire:chat.chat-messages  />
                </div>
               <div>
                   reply
               </div>
            </div>
        </div>
    </div>
    {{-- In work, do what you enjoy. --}}
</div>
