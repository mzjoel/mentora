<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 font-semibold text-xl leading-tight dark:text-gray-200 ">
            {{ __('MentoraAgent') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-6">
            <div class="dark:bg-black bg-gray-100 shadow-sm sm:rounded-lg overflow-hidden">
                <div id="chat" class="dark:text-gray-100 text-gray-800 p-6 overflow-y-auto"></div>
            </div>
            <div>
                <input type="text" id="message" placeholder="Ketik pesan....." class="w-full p-2 border rounded">
                <button id="send" class="bg-blue-500 text-white sm:rounded-xl px-6 py-2 mt-2">Kirim</button>
            </div>
        </div>
    </div>    
    
    
</x-app-layout>    
