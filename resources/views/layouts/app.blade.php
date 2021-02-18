<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="event-notification-box fixed right-0 top-0 bg-green-400 text-white mt-3 mr-3 px-5 py-3 rounded-lg shadow-lg transform duration-700 opacity-0">

                </div>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')


        @livewireScripts
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script>
            /**
             * surround native js code to instantiate a websocket client
             *
             * @param config
             * @returns {WebSocket}
             */
            function clientSocket(config = {}) {
                let route = config.route || "127.0.0.1";
                let port = config.port || "3280";
                window.Websocket = window.Websocket || window.MozWebSocket;
                return new WebSocket("ws://" + route + ":" + port);
            }
            //instantiate a connection
            var connection = clientSocket();

            /**
             * When the connection is open
             */
            connection.onopen = function () {
                console.log("Connection is open");
            }

            window.addEventListener('event-notification', event => {
                connection.send(JSON.stringify({
                    eventName: event.detail.eventName,
                    eventMessage: event.detail.eventMessage
                }));
            });

            //receives messages from websocket server
            connection.onmessage = function (message) {
                var result = JSON.parse(message.data);

                //begin animation -Display message
                $(".event-notification-box")
            }
        </script>
    </body>
</html>
