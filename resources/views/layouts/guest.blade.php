<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="darkMode()" x-init="init()">

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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body
    class="font-sans antialiased h-full bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-300">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <!-- Background decorations -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-[400px] h-[400px] bg-violet-500/10 rounded-full blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-400/5 rounded-full blur-3xl">
            </div>
            <!-- Grid pattern overlay -->
            <div class="absolute inset-0 opacity-[0.015]"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%236366f1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <!-- Logo -->
        <div class="relative z-10 mb-8">
            <a href="/" class="flex items-center group">
                <img x-show="!dark" x-cloak src="{{ asset('images/logo-dark.png') }}" alt="Logo"
                    class="h-12 w-auto transition-all duration-300">
                <img x-show="dark" x-cloak src="{{ asset('images/logo-light.png') }}" alt="Logo"
                    class="h-12 w-auto transition-all duration-300">
            </a>
        </div>

        <!-- Card -->
        <div
            class="relative z-10 w-full sm:max-w-md px-8 py-8 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-xl shadow-slate-200/50 dark:shadow-black/20 overflow-hidden sm:rounded-2xl border border-slate-200/80 dark:border-slate-700/80">
            {{ $slot }}
        </div>

        <!-- Dark mode toggle -->
        <div class="relative z-10 mt-6">
            <button @click="toggle()" type="button"
                class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-all duration-300 focus:outline-none"
                :title="dark ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                <svg x-show="dark" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg x-show="!dark" class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>
    </div>

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
</body>

</html>
