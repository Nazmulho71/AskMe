<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Get Qualified Solutions Easily</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/ba4be11306.js" crossorigin="anonymous"></script>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('AskMe.png') }}" type="image/x-icon">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    
    <body class="font-sans antialiased bg-gray-900 text-cool-gray-200">
        
        <div class="flex h-screen">
            <div class="m-auto" style="max-width: 34rem;">
                <div class="flex justify-around mb-10">
                    <img class="h-16 w-16" src="{{ asset('AskMe.png') }}" alt="AskMe - Get Qualified Solutions Easily">
                </div>
                
                <div class="block sm:inline-flex sm:items-center mb-10">
                    <div class="text-center mb-7 sm:text-right sm:mr-7">
                        <h1 class="text-3xl font-semibold">AskMe</h1>
                        <p class="text-cool-gray-300 text-lg">Get Qualified Solutions Easily</p>
                    </div>
    
                    <div id="line" class="border-l-2 border-gray-600 h-32 hidden sm:block"></div>
    
                    <div class="m-auto ml-0 sm:ml-7 sm:m-auto">
                        <div class="w-52 text-center m-auto">
                            <button onclick="action.login();" id="login" class="mb-2 block w-full px-4 py-2 align-middle whitespace-no-wrap bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">LOG IN</button>

                            <button onclick="action.register();" id="register" class="block w-full px-4 py-2 align-middle whitespace-no-wrap bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">REGISTER</button>
                        </div>
                    </div>
                </div>

                <div class="text-center text-cool-gray-400">
                    <p>A modern single-page forum designed with flexibility, and this has an easy routing system.</p>
                </div>
            </div>
        </div>

        <script>
            let action = {
                login: function() {
                    window.location = '/login';
                },

                register: function() {
                    window.location = '/register';
                }
            };
        </script>

    </body>
</html>
