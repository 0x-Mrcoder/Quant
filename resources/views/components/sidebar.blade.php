<div x-data="{ open: false }" class="flex-shrink-0">
    <!-- Mobile Menu Button -->
    <div class="fixed top-4 left-4 z-50 md:hidden">
        <button @click="open = !open" class="p-2 rounded-lg bg-black/50 backdrop-blur border border-white/10 text-white shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <!-- Sidebar -->
    <div :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
         class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-[#050505] border-r border-white/5 transition-transform duration-300 ease-in-out md:min-h-screen flex flex-col">
        
        <!-- Logo -->
        <div class="h-20 flex items-center px-8 border-b border-white/5">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-white tracking-tight">PipFlow</span>
            </a>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group">
                <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-brand-500/20 group-[.active]:bg-brand-500/20 transition-colors">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-400 group-[.active]:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span class="font-medium text-gray-400 group-hover:text-white group-[.active]:text-white">Dashboard</span>
            </x-nav-link>

            <!-- Accounts Link -->
            <x-nav-link :href="route('accounts.index')" :active="request()->routeIs('accounts.index')" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group">
                <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-brand-500/20 group-[.active]:bg-brand-500/20 transition-colors">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-brand-400 group-[.active]:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span class="font-medium text-gray-400 group-hover:text-white group-[.active]:text-white">Accounts</span>
            </x-nav-link>

            <x-nav-link :href="route('trading.index')" :active="request()->routeIs('trading.index')" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group">
                <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-brand-500/20 group-[.active]:bg-brand-500/20 transition-colors">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-brand-400 group-[.active]:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="font-medium text-gray-500 group-hover:text-white group-[.active]:text-white">Live Trading</span>
            </x-nav-link>


            
            <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group">
                <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-brand-500/20 group-[.active]:bg-brand-500/20 transition-colors">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-brand-400 group-[.active]:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="font-medium text-gray-500 group-hover:text-white group-[.active]:text-white">Settings</span>
            </x-nav-link>
        </nav>

        <!-- User Profile (Bottom) -->
        <div class="border-t border-white/5 p-4">
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5 border border-white/5">
                <div class="w-10 h-10 rounded-full bg-brand-500 flex items-center justify-center text-black font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
