<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Football Tickets') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-green-600 border-b border-green-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}" class="text-white font-bold text-xl">
                                    FootballTix
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <a href="{{ route('home') }}" 
                                   class="{{ request()->routeIs('home') ? 'border-white text-white' : 'border-transparent text-green-100 hover:text-white hover:border-green-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Home
                                </a>
                                @auth
                                    <a href="{{ route('my-tickets') }}" 
                                       class="{{ request()->routeIs('my-tickets') ? 'border-white text-white' : 'border-transparent text-green-100 hover:text-white hover:border-green-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        My Tickets
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}"
                                           class="{{ request()->routeIs('admin.*') ? 'border-white text-white' : 'border-transparent text-green-100 hover:text-white hover:border-green-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                            Admin Panel
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            @auth
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('profile.edit') }}" 
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md hover:bg-green-500 hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md hover:bg-green-500 hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('login') }}" 
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md hover:bg-green-500 hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                                        Login
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" 
                                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-600 bg-white border border-transparent rounded-md hover:bg-green-50 hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                                            Register
                                        </a>
                                    @endif
                                </div>
                            @endauth
                        </div>

                        <!-- Mobile menu button -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white/80 hover:bg-green-500 focus:outline-none focus:bg-green-500 focus:text-white transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-white hover:text-white/80 text-base font-medium">
                            Home
                        </a>
                        @auth
                            <a href="{{ route('my-tickets') }}" class="block pl-3 pr-4 py-2 text-white hover:text-white/80 text-base font-medium">
                                My Tickets
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 text-white hover:text-white/80 text-base font-medium">
                                    Admin Panel
                                </a>
                            @endif
                        @endauth
                    </div>

                    @auth
                        <div class="pt-4 pb-1 border-t border-green-500">
                            <div class="px-4">
                                <div class="font-medium text-base text-white">{{ auth()->user()->name }}</div>
                                <div class="font-medium text-sm text-green-100">{{ auth()->user()->email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-white/80">
                                    Profile
                                </x-responsive-nav-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="text-white hover:text-white/80">
                                        Log Out
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="pt-4 pb-1 border-t border-green-500">
                            <div class="space-y-1 px-4">
                                <a href="{{ route('login') }}" class="block py-2 text-white hover:text-white/80 text-base font-medium">
                                    Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block py-2 text-white hover:text-white/80 text-base font-medium">
                                        Register
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
