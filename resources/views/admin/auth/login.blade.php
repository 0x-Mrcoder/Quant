<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal - Quant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
</head>
<body class="bg-black text-white antialiased flex items-center justify-center min-h-[100dvh] relative font-sans selection:bg-amber-500/30">
    
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

    <div class="relative z-10 w-full max-w-[400px] mx-auto p-4 sm:p-0">
        <!-- Brand / Header -->
        <div class="text-center mb-8 space-y-2">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-600 mb-4 shadow-lg shadow-amber-500/20 border border-amber-400/20">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-amber-200 via-yellow-400 to-amber-600 tracking-tight drop-shadow-sm">Admin Access</h1>
            <p class="text-amber-500/60 text-sm md:text-base font-medium tracking-wide">QUANTUM FINANCIAL SYSTEM</p>
        </div>

        <!-- Glassmorphic Card -->
        <div class="bg-[#0a0a0a]/80 border border-amber-500/10 rounded-2xl p-6 md:p-8 backdrop-blur-xl shadow-2xl relative overflow-hidden group">
            <!-- Top Light Reflection -->
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-amber-500/50 to-transparent opacity-50"></div>

            <form method="POST" action="{{ route('admin.login.store') }}" class="relative z-10 space-y-5 md:space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-[10px] md:text-xs uppercase tracking-widest font-bold text-amber-500/80">Identity</label>
                    <div class="relative group/input transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-600 group-focus-within/input:text-amber-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                            class="block w-full pl-11 pr-4 py-3 bg-[#050505] border border-white/5 rounded-xl text-amber-100 placeholder-gray-700 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all outline-none sm:text-sm shadow-inner"
                            placeholder="admin@quant.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-[10px] md:text-xs uppercase tracking-widest font-bold text-amber-500/80">Passkey</label>
                    <div class="relative group/input transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-600 group-focus-within/input:text-amber-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="block w-full pl-11 pr-4 py-3 bg-[#050505] border border-white/5 rounded-xl text-amber-100 placeholder-gray-700 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all outline-none sm:text-sm shadow-inner"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full relative group overflow-hidden rounded-xl bg-gradient-to-b from-amber-400 to-amber-600 p-[1px] shadow-lg shadow-amber-900/50 active:scale-[0.98] transition-all duration-200 transform hover:-translate-y-0.5">
                        <div class="absolute inset-0 bg-white/20 group-hover:opacity-0 transition-opacity"></div>
                        <div class="relative px-6 py-3 bg-gradient-to-b from-amber-500 to-amber-700 rounded-xl flex items-center justify-center space-x-2 border-t border-white/20">
                            <span class="font-bold text-black tracking-wide text-sm md:text-base uppercase">Initiate Session</span>
                            <svg class="w-4 h-4 text-black transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 space-y-4">
            <div class="flex items-center justify-center gap-2 opacity-50 text-[10px] text-amber-500/40 uppercase tracking-widest font-mono">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                System Secure • 256-bit Encrypted
            </div>
            <a href="{{ route('login') }}" class="inline-flex items-center text-xs md:text-sm text-gray-600 hover:text-amber-500 transition-colors group">
                <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Return to Public Terminal
            </a>
        </div>
    </div>
</body>
</html>
