<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PipFlow AI') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased bg-[#050505] overflow-x-hidden selection:bg-brand-500 selection:text-black">
        
        <!-- Luxury Background -->
        <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
            <!-- Subtle Gold Glow Top Center -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-brand-500/10 rounded-full blur-[120px] opacity-40"></div>
            
            <!-- Deep Ambient Glow Bottom -->
            <div class="absolute bottom-0 left-0 w-full h-[400px] bg-gradient-to-t from-brand-900/10 to-transparent opacity-30"></div>

            <!-- Grid Pattern (Very Subtle) -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiIGZpbGw9Im5vbmUiLz4KPHBhdGggZD0iTTAgNDBMMTQwIDBoMjB2MjBMMCA0MHoiIGZpbGw9InJnYmEoMjU1LDIxNSwwLDAuMDMpIi8+Cjwvc3ZnPg==')] opacity-30"></div>
        </div>

        <div class="relative z-10 min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 p-6">
            <div class="mb-10 text-center animate-fade-in">
                <a href="/" class="flex flex-col items-center gap-4 group">
                    <div class="w-16 h-16 bg-gradient-to-br from-brand-400 to-brand-600 rounded-2xl flex items-center justify-center shadow-lg shadow-brand-500/20 group-hover:scale-105 transition-transform duration-500 border border-brand-400/20">
                        <svg class="w-9 h-9 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-200 via-brand-400 to-brand-200 tracking-tight drop-shadow-sm">PipFlow AI</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-[#0a0a0a]/80 backdrop-blur-xl border border-white/5 border-t-brand-500/20 shadow-2xl rounded-2xl animate-fade-in relative overflow-hidden ring-1 ring-white/5">
                <!-- Golden Shine effect -->
                <div class="absolute inset-0 bg-gradient-to-tr from-brand-500/5 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-sm text-gray-500 animate-fade-in" style="animation-delay: 0.2s">
                &copy; {{ date('Y') }} PipFlow AI. Smart Trading.
            </div>
        </div>
    </body>
</html>
