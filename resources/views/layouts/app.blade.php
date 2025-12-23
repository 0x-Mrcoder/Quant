<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PipFlow AI') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#050505] text-white overflow-hidden selection:bg-brand-500 selection:text-black">
        <div class="flex h-screen overflow-hidden bg-[#050505]">
            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                <!-- Top Header (Mobile only really needed, or for search) -->
                <header class="flex items-center justify-between px-6 py-4 md:hidden border-b border-white/5 bg-[#0a0a0a]">
                    <div class="flex items-center">
                        <span class="text-lg font-bold">PipFlow</span>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-4 md:p-8 relative">
                    <!-- Background Glows -->
                    <div class="fixed inset-0 pointer-events-none z-0">
                        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-500/5 rounded-full blur-[100px] opacity-20"></div>
                        <div class="absolute bottom-0 left-20 w-[600px] h-[600px] bg-accent-500/5 rounded-full blur-[120px] opacity-20"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
