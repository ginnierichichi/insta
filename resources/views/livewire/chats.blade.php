<div class="grid grid-cols-3 space-x-4">
    <div>
        <livewire:chat.chat-list :chats="$user->chats"/>
    </div>
    @if($selectedChat)
    <div class="col-span-2 pt-2 h-xl">
        <div class="bg-white rounded-lg w-3/4 p-4 h-full">
            <div >
                <livewire:chat.chat-users  />
            </div>
            <div class="h-5/6">
                <livewire:chat.chat-messages :messages="$selectedChat->messages"/>
            </div>
           <div class="pt-6">
               reply
               <livewire:chat.reply :chat="$selectedChat"/>
           </div>
        </div>
    </div>
    @endif
</div>
    {{-- In work, do what you enjoy. --}}

