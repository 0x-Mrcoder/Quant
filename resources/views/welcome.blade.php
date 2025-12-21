<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Quant AI') }} - Institutional Grade Trading</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        .text-glow { text-shadow: 0 0 20px rgba(245, 158, 11, 0.4); }
        .bg-glass { background: rgba(10, 10, 10, 0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
    </style>
</head>
<body class="antialiased bg-rich-black-900 text-gray-300 font-sans selection:bg-brand-500 selection:text-black">

    <!-- Background Effects -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-brand-500/10 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-brand-500/5 blur-[120px]"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-300" 
         x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="{ 'bg-glass border-b border-white/5': scrolled, 'bg-transparent': !scrolled }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center shadow-lg shadow-brand-500/20">
                            <svg class="w-5 h-5 text-black" fill="none" class="w-5 h-5 text-black" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-white">Quant<span class="text-brand-500">.ai</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-sm font-medium hover:text-brand-400 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium hover:text-brand-400 transition-colors">How it works</a>
                    <a href="#pricing" class="text-sm font-medium hover:text-brand-400 transition-colors">Pricing</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center gap-4 ml-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-black bg-brand-500 rounded-lg hover:bg-brand-400 transition-all shadow-lg shadow-brand-500/20">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-white transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-black bg-gradient-to-r from-brand-400 to-brand-600 rounded-lg hover:to-brand-500 transition-all shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-8" x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-medium text-brand-400"
                         x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 -translate-x-4">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                        </span>
                        v2.4 Algorithm Live
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-display font-bold leading-tight text-white mb-6"
                        x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                        The First Autonomous <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-brand-500 to-brand-300 text-glow">
                            AI Trader for Everyone
                        </span>
                    </h1>

                    <p class="text-lg text-gray-400 max-w-lg leading-relaxed"
                       x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 translate-y-8">
                        No technical experience? No problem. Our AI combines Technical Analysis, Fundamental News, and Risk Management to trade for you 24/7. Just connect and start.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4"
                         x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500" x-transition:enter-start="opacity-0 translate-y-8">
                        <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-brand-500 hover:bg-brand-400 text-black font-bold rounded-xl shadow-xl shadow-brand-500/20 transition-all hover:scale-105 flex items-center justify-center gap-2 overflow-hidden">
                            <span class="relative z-10">Start Trading Now</span>
                            <svg class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            <div class="absolute inset-0 h-full w-full scale-0 rounded-2xl transition-all duration-300 group-hover:scale-100 group-hover:bg-brand-400/30"></div>
                        </a>
                        <a href="#how-it-works" class="px-8 py-4 bg-white/5 hover:bg-white/10 text-white font-semibold rounded-xl border border-white/10 transition-all hover:border-white/20 flex items-center justify-center">
                            See Performance
                        </a>
                    </div>

                    <div class="flex items-center gap-8 pt-8 border-t border-white/5" 
                         x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700" x-transition:enter-start="opacity-0">
                        <div>
                            <p class="text-3xl font-bold text-white">98<span class="text-brand-500 text-lg">%</span></p>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Uptime</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-white">$24<span class="text-brand-500 text-lg">M+</span></p>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Volume</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-white">0.1<span class="text-brand-500 text-lg">s</span></p>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Latency</p>
                        </div>
                    </div>
                </div>

                <!-- Visual Content -->
                <div class="relative hidden lg:block" x-data x-init="$el.classList.add('animate-float')">
                    <!-- Glass Card Visualization -->
                    <div class="relative z-10 bg-glass border border-white/10 rounded-2xl p-6 shadow-2xl backdrop-blur-xl">
                        <!-- Mock Chart Header -->
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center text-yellow-500 font-bold">Gold</div>
                                <div>
                                    <h3 class="text-white font-bold">XAUUSD</h3>
                                    <p class="text-xs text-green-400 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                        Market Open
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-mono font-bold text-white">2,034.50</p>
                                <p class="text-sm text-green-400">+1.24% (+24.10)</p>
                            </div>
                        </div>

                        <!-- Mock Chart Area -->
                        <div class="h-64 w-full bg-gradient-to-t from-brand-500/10 to-transparent rounded-lg border border-white/5 relative overflow-hidden flex items-end px-1 gap-1">
                             <!-- Animated Bars via Inline JS for effect -->
                             @for($i = 0; $i < 30; $i++)
                                <div class="flex-1 bg-brand-500/50 rounded-t-sm animate-pulse" 
                                     style="height: {{ rand(20, 90) }}%; animation-delay: {{ $i * 0.1 }}s"></div>
                             @endfor
                        </div>

                        <!-- AI Signal Badge -->
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-rich-black/90 border border-brand-500/50 px-6 py-3 rounded-xl shadow-2xl flex items-center gap-3">
                            <div class="relative">
                                <div class="w-3 h-3 bg-brand-500 rounded-full"></div>
                                <div class="absolute inset-0 w-3 h-3 bg-brand-500 rounded-full animate-ping"></div>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest">AI Signal</p>
                                <p class="text-brand-400 font-bold text-lg">STRONG BUY</p>
                            </div>
                        </div>
                    </div>

                    <!-- Decor Elements -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners / Tech Stack -->
    <section class="py-10 border-y border-white/5 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm text-gray-600 mb-6 uppercase tracking-widest">Powered By</p>
            <div class="flex flex-wrap justify-center gap-12 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <span class="text-xl font-bold text-white">OPENAI</span>
                <span class="text-xl font-bold text-white">TRADINGVIEW</span>
                <span class="text-xl font-bold text-white">METAQUOTES</span>
                <span class="text-xl font-bold text-white">AWS</span>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">Complete AI Reasoning Engine</h2>
                <p class="text-gray-400">It doesn't just execute. It thinks, analyzes, and protects your capital.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-brand-500/50 hover:bg-white/10 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-brand-500/20 to-brand-500/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Multi-Dimensional Analysis</h3>
                    <p class="text-gray-400 leading-relaxed">
                        The AI processes Technical Charts and Fundamental News simultaneously. It understands market structure and reacts to global events instantly.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="group p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-brand-500/50 hover:bg-white/10 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-brand-500/20 to-brand-500/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Psychology & Discipline</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Eliminate human error and emotion. The AI applies strict reasoning and psychological safeguards to every trade, ensuring consistency.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="group p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-brand-500/50 hover:bg-white/10 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-brand-500/20 to-brand-500/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Capital Protection 24/7</h3>
                    <p class="text-gray-400 leading-relaxed">
                        No installation needed. Our cloud-based system runs 24/7 protecting your account with advanced risk management protocols.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 bg-black/40 border-y border-white/5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-500/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">From Setup to Profit in Minutes</h2>
                <p class="text-gray-400">We've stripped away the complexity. No coding required.</p>
            </div>

            <div class="relative">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-gradient-to-r from-white/5 via-brand-500/50 to-white/5 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative z-10">
                    <!-- Step 1 -->
                    <div class="group">
                        <div class="w-24 h-24 mx-auto bg-rich-black-900 border border-white/10 rounded-full flex items-center justify-center mb-8 relative group-hover:border-brand-500 transition-colors duration-500 shadow-2xl">
                             <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-white group-hover:text-brand-500 transition-colors">1</span>
                             </div>
                             <!-- Icon Badge -->
                             <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-brand-500 text-black rounded-full flex items-center justify-center border-4 border-rich-black-900">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                             </div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Connect Broker</h3>
                        <p class="text-gray-400 text-sm leading-relaxed px-4">
                            Link your existing MT4, MT5, or Deriv account securely via our API bridge.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="group">
                        <div class="w-24 h-24 mx-auto bg-rich-black-900 border border-white/10 rounded-full flex items-center justify-center mb-8 relative group-hover:border-brand-500 transition-colors duration-500 shadow-2xl">
                             <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-white group-hover:text-brand-500 transition-colors">2</span>
                             </div>
                             <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-brand-500 text-black rounded-full flex items-center justify-center border-4 border-rich-black-900">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                             </div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Configure Risk</h3>
                        <p class="text-gray-400 text-sm leading-relaxed px-4">
                            Set your maximum drawdown limit. Our system automatically halts trading if reached.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="group">
                        <div class="w-24 h-24 mx-auto bg-rich-black-900 border border-white/10 rounded-full flex items-center justify-center mb-8 relative group-hover:border-brand-500 transition-colors duration-500 shadow-2xl">
                             <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-white group-hover:text-brand-500 transition-colors">3</span>
                             </div>
                             <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-brand-500 text-black rounded-full flex items-center justify-center border-4 border-rich-black-900">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                             </div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Activate AI</h3>
                        <p class="text-gray-400 text-sm leading-relaxed px-4">
                            Toggle the switch. Watch as the neural network begins scanning for institutional entries.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-4">Transparent Pricing</h2>
                <p class="text-gray-400">Choose the level of intelligence that fits your portfolio.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Starter Plan -->
                <div class="p-8 rounded-2xl bg-white/5 border border-white/10 flex flex-col hover:bg-white/10 transition-colors">
                    <h3 class="text-xl font-bold text-white mb-2">Starter</h3>
                    <p class="text-gray-400 text-sm mb-6">For traders exploring AI automation.</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-white">$0</span>
                        <span class="text-gray-500">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-center text-gray-300 text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            1 Trading Account
                        </li>
                        <li class="flex items-center text-gray-300 text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Basic Risk Management
                        </li>
                        <li class="flex items-center text-gray-300 text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Standard Execution Speed
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="w-full py-3 px-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition-colors text-center">Get Started</a>
                </div>

                <!-- Pro Plan (Highlighted) -->
                <div class="relative p-8 rounded-2xl bg-gradient-to-b from-brand-900/50 to-black border border-brand-500/50 flex flex-col shadow-2xl shadow-brand-500/10 transform md:-translate-y-4">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-brand-500 text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Most Popular</div>
                    <h3 class="text-xl font-bold text-white mb-2">Professional</h3>
                    <p class="text-gray-400 text-sm mb-6">For serious traders seeking an edge.</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-white">$49</span>
                        <span class="text-gray-500">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-center text-white text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Up to 5 Trading Accounts
                        </li>
                        <li class="flex items-center text-white text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Advanced Sentiment AI
                        </li>
                        <li class="flex items-center text-white text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Ultra-Low Latency (<100ms)
                        </li>
                        <li class="flex items-center text-white text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Priority Support
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="w-full py-3 px-4 bg-brand-500 hover:bg-brand-400 text-black font-bold rounded-lg transition-colors text-center shadow-lg shadow-brand-500/20">Start Free Trial</a>
                </div>

                <!-- Enterprise Plan -->
                <div class="p-8 rounded-2xl bg-white/5 border border-white/10 flex flex-col hover:bg-white/10 transition-colors">
                    <h3 class="text-xl font-bold text-white mb-2">Institutional</h3>
                    <p class="text-gray-400 text-sm mb-6">Custom solutions for funds & props.</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-white">$299</span>
                        <span class="text-gray-500">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-center text-gray-300 text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Unlimited Accounts
                        </li>
                        <li class="flex items-center text-gray-300 text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Dedicated Server Infrastructure
                        </li>
                        <li class="flex items-center text-gray-300 text-sm">
                            <svg class="w-5 h-5 text-brand-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Custom Algorithm Logic
                        </li>
                    </ul>
                    <a href="#" class="w-full py-3 px-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition-colors text-center">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Dark CTA Section -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-brand-500/5"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-4xl lg:text-5xl font-display font-bold text-white mb-6">Ready to Automate Your Success?</h2>
            <p class="text-xl text-gray-400 mb-10">Join 1,000+ traders who have switched to AI-driven execution.</p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                 <a href="{{ route('register') }}" class="px-8 py-4 bg-brand-500 hover:bg-brand-400 text-black font-bold rounded-xl shadow-xl shadow-brand-500/20 transition-all hover:scale-105">
                    Create Free Account
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black border-t border-white/10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                     <span class="font-display font-bold text-2xl text-white">Quant<span class="text-brand-500">.ai</span></span>
                     <p class="text-gray-500 mt-4 max-w-xs">
                         Advanced algorithmic trading solutions for the modern investor.
                     </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Platform</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand-500">Features</a></li>
                        <li><a href="#" class="hover:text-brand-500">Pricing</a></li>
                        <li><a href="#" class="hover:text-brand-500">Docs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4">Legal</h4>
                     <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand-500">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-brand-500">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-brand-500">Risk Disclosure</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-between items-center pt-8 border-t border-white/10">
                <p class="text-xs text-gray-600">&copy; {{ date('Y') }} Quant AI. All rights reserved.</p>
                <div class="flex gap-6">
                    <!-- X (Twitter) -->
                    <a href="#" class="text-gray-500 hover:text-white transition-colors">
                        <span class="sr-only">X</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                        </svg>
                    </a>

                    <!-- GitHub -->
                    <a href="#" class="text-gray-500 hover:text-white transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <!-- Discord -->
                    <a href="#" class="text-gray-500 hover:text-white transition-colors">
                        <span class="sr-only">Discord</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.419-2.1568 2.419zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.419-2.1568 2.419z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
