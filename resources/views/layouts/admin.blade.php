<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quant Admin') }} - Admin Portal</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-black text-white selection:bg-amber-500/30 overflow-hidden">
        
        <!-- Dynamic Background Effects -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <!-- Gold Glows -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-amber-600/10 rounded-full mix-blend-screen filter blur-[128px] opacity-40 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-yellow-500/10 rounded-full mix-blend-screen filter blur-[128px] opacity-40 animate-blob animation-delay-2000"></div>
            <!-- Deep Bottom Glow -->
            <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-orange-900/20 rounded-full mix-blend-screen filter blur-[128px] opacity-40 animate-blob animation-delay-4000"></div>
            
            <!-- Hex Grid Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI0NSwgMTU4LCAxMSwgMC4wNSkiIHN0cm9rZS13aWR0aD0iMSI+PHBhdGggZD0iTTEyIDJMMiA3djEwbDEwIDUgMTAtNXYtMTBMMTIgMnoiIC8+PC9zdmc+')] [mask-image:radial-gradient(ellipse_at_center,white,transparent_70%)]"></div>
        </div>

        <!-- Admin Shell -->
        <div class="relative z-10 h-screen flex overflow-hidden" x-data="{ sidebarOpen: false }">
            
            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/80 z-20 md:hidden"></div>

            <!-- Admin Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="absolute md:relative z-30 w-64 h-full border-r border-amber-500/10 bg-black/80 backdrop-blur-xl p-6 flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 md:block">
                <div class="mb-10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                         <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-amber-400 to-yellow-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                            <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold bg-gradient-to-r from-amber-200 via-yellow-400 to-amber-600 bg-clip-text text-transparent tracking-tight">Admin OS</h2>
                    </div>
                    <!-- Close button for mobile -->
                    <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <nav class="space-y-2 flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500/10 text-amber-300 border border-amber-500/20 shadow-[0_0_15px_-3px_rgba(245,158,11,0.1)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition-all group font-medium">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? '' : 'group-hover:text-amber-500' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-amber-500/10 text-amber-300 border border-amber-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? '' : 'group-hover:text-amber-500' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        User Base
                    </a>
                    <a href="{{ route('admin.trading.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.trading.*') ? 'bg-amber-500/10 text-amber-300 border border-amber-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.trading.*') ? '' : 'group-hover:text-amber-500' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Trading Monitor
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all group">
                        <svg class="w-5 h-5 group-hover:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        System Config
                    </a>
                </nav>
                <div class="mt-auto pt-8 border-t border-amber-500/10 mt-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm text-gray-500 hover:text-amber-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Exit to Terminal
                    </a>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                <!-- Mobile Header -->
                <div class="md:hidden flex items-center justify-between p-4 bg-black/40 border-b border-amber-500/10">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-gradient-to-tr from-amber-400 to-yellow-600 flex items-center justify-center">
                            <svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <span class="font-bold text-amber-500">Admin OS</span>
                    </div>
                    <button @click="sidebarOpen = true" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>

                <!-- Content Area -->
                <main class="flex-1 w-full max-w-full overflow-y-auto overflow-x-hidden p-2 sm:p-4 md:p-8 bg-transparent relative z-10 scrollbar-thin scrollbar-thumb-amber-500/20 scrollbar-track-transparent">
                    @yield('content')
                </main>

            </div>
        </div>
        
        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>
</html>
