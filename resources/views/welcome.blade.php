<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chefcito</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="flex items-center min-h-screen bg-white">
            <!-- Sección Izquierda: Texto e Información -->
            <div class="w-1/2 px-8 space-y-6">
                <!-- Navegación -->
                <div class="flex items-center justify-between mb-6">
                    <img src="{{ asset('assets/logo.svg') }}" alt="Logo" class="h-12"> <!-- Reemplaza con el logo real -->
                    <nav class="space-x-8 text-gray-700">
                        <a href="#" class="hover:text-purple-800">Inicio</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-purple-800 ring-1 ring-transparent transition hover:text-purple-800/70 focus:outline-none focus-visible:ring-[#FF2D20]">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-purple-800 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">Log in</a>
                            @endauth
                        @endif
                    </nav>
                </div>

                <!-- Título y Descripción -->
                <div>
                    <h1 class="py-4 text-5xl font-bold text-purple-500">CHEFCITO</h1>
                    <p class="text-gray-500">Descubre los mejores platos para disfrutar en cualquier momento.</p>
                </div>

                <!-- Botón de acceso -->
                <div>
                    <button class="px-6 py-3 font-semibold text-white bg-purple-800 rounded-full hover:bg-gray-800">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20]">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20]">Log in</a>
                            @endauth
                        @endif
                    </button>
                </div>
            </div>

            <!-- Sección Derecha: Imagen del Platillo -->
            <div class="relative flex items-center justify-center w-1/2">
                <!-- Imagen del Platillo -->
                <img src="https://static.vecteezy.com/system/resources/previews/029/139/918/non_2x/delicious-food-restaurant-food-top-view-food-with-transparent-background-ai-generative-free-png.png" alt="Dish" class="w-3/4 bg-purple-400 rounded-full shadow-xl">

                <!-- Elementos decorativos -->
                <div class="absolute w-8 h-8 bg-[#8C52FF] rounded-full -left-10 -top-10"></div>
                <div class="absolute w-4 h-4 bg-purple-500 rounded-full bottom-20 -left-8"></div>
                <div class="absolute w-20 h-20 bg-black rounded-full opacity-20 -bottom-16 right-4"></div>
            </div>
        </div>

    </body>
</html>
