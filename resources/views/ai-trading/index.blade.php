<x-app-layout>
    <div class="py-12 bg-rich-black-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">AI Strategy Center</h2>
                    <p class="text-gray-400">Configure your autonomous trading agent's behavior and risk parameters.</p>
                </div>
                <div class="flex space-x-4">
                    <div class="flex items-center space-x-2 bg-rich-black-800 px-4 py-2 rounded-lg border border-white/5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-emerald-400 font-medium text-sm">AI Engine Active</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('ai-trading.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Strategy & Pair -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Intelligent Strategy Selector -->
                        <div class="bg-rich-black-800 rounded-2xl p-6 border border-white/5 shadow-xl relative overflow-hidden group">
                            <!-- Aurora Glow -->
                            <div class="absolute -top-24 -right-24 w-64 h-64 bg-brand-500/10 rounded-full blur-3xl group-hover:bg-brand-500/20 transition duration-500"></div>

                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                                        <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        Strategy Mode
                                    </h3>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-brand-500/20 text-brand-300">
                                        Current: {{ $config->strategy_mode }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach(['SMC' => 'Smart Money Concepts', 'ICT' => 'Inner Circle Trader', 'Price Action' => 'Pure Price Action', 'Hybrid' => 'AI Optimized Hybrid'] as $value => $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="strategy_mode" value="{{ $value }}" class="peer sr-only" {{ $config->strategy_mode == $value ? 'checked' : '' }}>
                                        <div class="p-4 rounded-xl border border-white/10 bg-rich-black-900/50 hover:bg-rich-black-700/50 transition-all duration-300 peer-checked:border-brand-500 peer-checked:bg-brand-500/10 peer-checked:shadow-[0_0_20px_rgba(99,102,241,0.15)]">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="font-semibold text-gray-200 peer-checked:text-brand-400">{{ $label }}</span>
                                                <div class="w-4 h-4 rounded-full border border-gray-600 peer-checked:border-brand-500 peer-checked:bg-brand-500"></div>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                @if($value == 'SMC') Order blocks, liquidity grabs, and FVG detection.
                                                @elseif($value == 'ICT') Kill zones, optimal trade entry, and silver bullet.
                                                @elseif($value == 'Price Action') Support/Resistance, trendlines, and candlestick patterns.
                                                @else Combines all strategies dynamically based on market conditions.
                                                @endif
                                            </p>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Trading Pair Selection -->
                        <div class="bg-rich-black-800 rounded-2xl p-6 border border-white/5 shadow-xl">
                            <h3 class="text-xl font-semibold text-white mb-4 flex items-center gap-2">
                                <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Active Assets
                            </h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Primary Pair</label>
                                <select name="trading_pair" class="w-full bg-rich-black-900 border border-white/10 rounded-lg text-white px-4 py-3 focus:ring-brand-500 focus:border-brand-500">
                                    <option value="EURUSD" {{ $config->trading_pair == 'EURUSD' ? 'selected' : '' }}>EUR/USD - Euro / US Dollar</option>
                                    <option value="GBPUSD" {{ $config->trading_pair == 'GBPUSD' ? 'selected' : '' }}>GBP/USD - British Pound / US Dollar</option>
                                    <option value="XAUUSD" {{ $config->trading_pair == 'XAUUSD' ? 'selected' : '' }}>XAU/USD - Gold</option>
                                    <option value="BTCUSD" {{ $config->trading_pair == 'BTCUSD' ? 'selected' : '' }}>BTC/USD - Bitcoin</option>
                                </select>
                                <p class="mt-2 text-xs text-gray-500">The AI will primarily monitor and trade this pair based on your subscription tier.</p>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Risk & Protection -->
                    <div class="space-y-8">
                        
                        <!-- Risk Profile -->
                        <div class="bg-rich-black-800 rounded-2xl p-6 border border-white/5 shadow-xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-500/5 rounded-bl-full"></div>
                            
                            <h3 class="text-xl font-semibold text-white mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Risk Management
                            </h3>

                            <div class="space-y-4">
                                @foreach(['Safe', 'Moderate', 'Aggressive', 'Capital Protection'] as $mode)
                                <label class="flex items-center justify-between p-3 rounded-lg border border-white/5 hover:bg-white/5 cursor-pointer transition">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="risk_mode" value="{{ $mode }}" class="text-brand-500 focus:ring-brand-500 bg-rich-black-900 border-gray-600" {{ $config->risk_mode == $mode ? 'checked' : '' }}>
                                        <div>
                                            <span class="block text-sm font-medium text-gray-200">{{ $mode }}</span>
                                            <span class="block text-xs text-gray-500">
                                                @if($mode == 'Safe') Low drawdown, high win-rate focus.
                                                @elseif($mode == 'Moderate') Balanced risk/reward ratio.
                                                @elseif($mode == 'Aggressive') Maximizes growth, higher volatility.
                                                @else Extreme conservatism, capital preservation.
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    @if($config->risk_mode == $mode)
                                        <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                                    @endif
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Auto-Pilot Settings -->
                        <div class="bg-rich-black-800 rounded-2xl p-6 border border-white/5 shadow-xl">
                            <h3 class="text-xl font-semibold text-white mb-6">Automation</h3>
                            
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-200">Auto SL/TP</h4>
                                        <p class="text-xs text-gray-500">AI sets dynamic entries and exits.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="auto_sl_tp" value="1" class="sr-only peer" {{ $config->auto_sl_tp ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-500"></div>
                                    </label>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-200">News Filter</h4>
                                        <p class="text-xs text-gray-500">Pause trading during high-impact news.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="news_reaction" value="1" class="sr-only peer" {{ $config->news_reaction ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-500"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white font-bold rounded-xl shadow-lg shadow-brand-500/25 transition-all duration-300 transform hover:scale-[1.02]">
                            Save Configuration
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
