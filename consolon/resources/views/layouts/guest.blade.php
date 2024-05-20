<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex h-screen bg-gray-900">
        <!-- Left Section -->
        <div class="flex w-1/4 flex-col justify-between bg-gray-800">
            <!-- Search Bar -->
            <div class="h-10 w-full bg-gray-700 pl-4 flex items-center text-white font-bold">CONSOLON</div>

            <x-guestleftbar />
        </div>

        <!-- Right Section -->

        <label style="max-height:100%;box-sizing:border-box;display:flex;flex-direction:column;" class="w-3/4 border-l border-gray-400 bg-black">
            <!-- Current Partner Info -->
            <x-current-partner>
                {{Route::is("login") ? "login" : "register"}}
            </x-current-partner>
            <!-- Messages -->
            <div style="height:100%;" class="overflow-hidden px-4 py-2">
                <div id="chat" style="height:100%;" class="overflow-y-auto"></div>

                <x-guest-entry />
                <script>
                    const chat = document.getElementById("chat");
                    const entry = document.getElementById("entry");
                    let username = '';
                    let password = '';

                    function messageComponent(mtype, message) {
                        switch (mtype) {
                            case "error":
                                return `<div class="text-black font-bold bg-red-400 w-fit px-2"> ! ${message} </div>`
                            case "info":
                                return `<div class="text-blue-600"> * ${message} > </div>`
                            case "recieved":
                                return `<div class="text-green-400"> ${message} </div>`
                            case "sent":
                                return `<div class="text-white"> ${message} </div>`
                        }
                    }

                    function chatm(mtype, message) {
                        chatlog(messageComponent(mtype, message));
                    }

                    function chatlog(logHTML) {
                        chat.innerHTML += logHTML;
                    }
                </script>
                {{$slot}}
            </div>
        </label>
    </div>
</body>


</html>