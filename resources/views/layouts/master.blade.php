<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="darkMode()" x-init="init()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Career 180') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Dark Mode Script (runs before paint to prevent flash) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body
    class="font-sans antialiased h-full flex flex-col bg-slate-50 text-gray-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">
    <!-- Navbar -->
    <nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.scrollY > 20)"
        :class="scrolled ? 'bg-slate-900/95 dark:bg-slate-800/95 backdrop-blur-xl shadow-lg shadow-black/10' :
            'bg-slate-900 dark:bg-slate-900'"
        class="sticky top-0 z-50 transition-all duration-300 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 lg:h-18">
                <div class="flex items-center">
                    <a href="/" wire:navigate class="flex items-center group">
                        <img x-show="!dark" x-cloak src="{{ asset('images/logo-dark.png') }}" alt="Logo"
                            class="hidden sm:block h-10 lg:h-12 w-auto transition-all duration-300">
                        <img x-show="dark" x-cloak src="{{ asset('images/logo-light.png') }}" alt="Logo"
                            class="hidden sm:block h-10 lg:h-12 w-auto transition-all duration-300">
                        <img src="{{ asset('images/logo-mobile.png') }}" alt="Logo"
                            class="block sm:hidden h-9 w-auto">
                    </a>
                </div>

                <!-- Desktop Nav -->
                <div class="hidden sm:flex sm:items-center sm:space-x-2">
                    @auth
                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="relative px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-200 group">
                            <svg class="inline-block w-4 h-4 mr-1.5 -mt-0.5 opacity-60 group-hover:opacity-100 transition"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </a>
                    @endauth

                    <!-- Dark/Light Mode Toggle -->
                    <button @click="toggle()" type="button"
                        class="relative p-2 rounded-xl text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                        :title="dark ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                        <svg x-show="dark" x-cloak x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 rotate-[-90deg] scale-0"
                            x-transition:enter-end="opacity-100 rotate-0 scale-100" class="w-5 h-5 text-amber-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg x-show="!dark" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 rotate-90 scale-0"
                            x-transition:enter-end="opacity-100 rotate-0 scale-100" class="w-5 h-5 text-indigo-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    @auth
                        <div class="ms-2 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
                                        <div
                                            class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold text-xs mr-2 shadow-lg shadow-indigo-500/30">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                                        <svg class="ms-1.5 h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile')" wire:navigate>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-200">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 border border-indigo-400/20 rounded-xl font-semibold text-sm text-white tracking-wide shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0">
                                Get Started
                                <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <!-- Mobile Dark Mode Toggle -->
                    <button @click="toggle()" type="button"
                        class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/10 transition-all duration-300 focus:outline-none mr-1">
                        <svg x-show="dark" x-cloak class="w-5 h-5 text-amber-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg x-show="!dark" class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/10 focus:outline-none transition duration-200">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{ 'block': open, 'hidden': !open }"
            class="hidden sm:hidden bg-slate-800/95 backdrop-blur-xl border-t border-white/5">
            <div class="pt-3 pb-4 px-4 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('dashboard')" wire:navigate>Dashboard</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="relative bg-slate-900 dark:bg-slate-950 text-slate-400 mt-auto overflow-hidden">
        <!-- Top gradient line -->
        <div class="h-px bg-gradient-to-r from-transparent via-indigo-500 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <a href="/" class="flex items-center mb-5 group">
                        <img src="{{ asset('images/logo-light.png') }}" alt="Logo" class="h-10 lg:h-12 w-auto">
                    </a>
                    <p class="text-sm leading-relaxed text-slate-500 max-w-xs">
                        Unlock your potential with industry-recognized courses and certifications designed for the
                        modern career.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-slate-300 mb-5">Platform</h4>
                    <ul class="space-y-3">
                        <li><a href="/" wire:navigate
                                class="text-sm hover:text-indigo-400 transition-colors duration-200">Browse Courses</a>
                        </li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" wire:navigate
                                    class="text-sm hover:text-indigo-400 transition-colors duration-200">My Dashboard</a>
                            </li>
                        @endauth
                    </ul>
                </div>

                <!-- Account -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-slate-300 mb-5">Account</h4>
                    <ul class="space-y-3">
                        @guest
                            <li><a href="{{ route('login') }}"
                                    class="text-sm hover:text-indigo-400 transition-colors duration-200">Sign In</a></li>
                            <li><a href="{{ route('register') }}"
                                    class="text-sm hover:text-indigo-400 transition-colors duration-200">Create Account</a>
                            </li>
                        @else
                            <li><a href="{{ route('profile') }}" wire:navigate
                                    class="text-sm hover:text-indigo-400 transition-colors duration-200">Profile
                                    Settings</a></li>
                        @endguest
                    </ul>
                </div>
            </div>

            <!-- Bottom bar -->
            <div
                class="mt-14 pt-8 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} Career 180. All rights reserved.
                </p>
                <div class="flex items-center space-x-1 text-xs text-slate-600">
                    <span>Crafted with</span>
                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>for learners everywhere</span>
                </div>
            </div>
        </div>

        <!-- Decorative blurred circles -->
        <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-indigo-600/5 rounded-full blur-3xl pointer-events-none">
        </div>
        <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-violet-600/5 rounded-full blur-3xl pointer-events-none">
        </div>
    </footer>

    <!-- Dark Mode Alpine Component -->
    <script>
        function darkMode() {
            return {
                dark: false,
                init() {
                    this.dark = localStorage.theme === 'dark' ||
                        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    this.applyTheme();

                    document.addEventListener('livewire:navigated', () => {
                        this.applyTheme();
                    });

                    this.$watch('dark', () => this.applyTheme());
                },
                toggle() {
                    this.dark = !this.dark;
                    localStorage.theme = this.dark ? 'dark' : 'light';
                },
                applyTheme() {
                    document.documentElement.classList.toggle('dark', this.dark);
                }
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
