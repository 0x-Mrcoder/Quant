<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">AI Strategy Center</h2>
                    <p class="text-gray-400">Configure your autonomous trading agent's behavior and risk parameters.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 bg-[#1a1a1a] border border-emerald-500/20 rounded-xl flex items-center gap-2 shadow-lg shadow-emerald-500/5">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-emerald-400 font-bold text-sm tracking-wide">AI ENGINE ACTIVE</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('ai-trading.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Strategy & Pair -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Intelligent Strategy Selector -->
                        <div class="bg-[#1a1a1a] rounded-3xl p-8 border border-white/5 shadow-2xl relative overflow-hidden group">
                            <!-- Aurora Glow -->
                            <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-500/10 rounded-full blur-[100px] group-hover:bg-brand-500/20 transition duration-1000"></div>

                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-8">
                                    <h3 class="text-xl font-bold text-white flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 flex items-center justify-center border border-brand-500/20">
                                            <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                        </div>
                                        Strategy Logic
                                    </h3>
                                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-500/10 text-brand-400 border border-brand-500/20">
                                        {{ $config->strategy_mode }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach(['SMC' => 'Smart Money Concepts', 'ICT' => 'Inner Circle Trader', 'Price Action' => 'Pure Price Action', 'Hybrid' => 'AI Optimized Hybrid'] as $value => $label)
                                    <label class="cursor-pointer group/item">
                                        <input type="radio" name="strategy_mode" value="{{ $value }}" class="peer sr-only" {{ $config->strategy_mode == $value ? 'checked' : '' }}>
                                        <div class="relative p-5 rounded-2xl border border-white/5 bg-white/5 hover:bg-white/10 transition-all duration-300 peer-checked:border-brand-500 peer-checked:bg-brand-500/10 peer-checked:shadow-[0_0_30px_rgba(99,102,241,0.15)] overflow-hidden">
                                            <div class="flex items-center justify-between mb-2 relative z-10">
                                                <span class="font-bold text-gray-200 peer-checked:text-white text-lg">{{ $label }}</span>
                                                <div class="w-5 h-5 rounded-full border-2 border-gray-600 peer-checked:border-brand-500 peer-checked:bg-brand-500 flex items-center justify-center transition-all">
                                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 font-medium leading-relaxed relative z-10">
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
                        <div class="bg-[#1a1a1a] rounded-3xl p-8 border border-white/5 shadow-2xl">
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                Active Asset Allocation
                            </h3>
                            <div class="relative">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Primary Trading Pair</label>
                                <div class="relative group">
                                    <select name="trading_pair" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl text-white px-5 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none font-bold text-lg transition-all shadow-inner">
                                        <option value="EURUSD" {{ $config->trading_pair == 'EURUSD' ? 'selected' : '' }}>EUR/USD - Euro / US Dollar</option>
                                        <option value="GBPUSD" {{ $config->trading_pair == 'GBPUSD' ? 'selected' : '' }}>GBP/USD - British Pound / US Dollar</option>
                                        <option value="XAUUSD" {{ $config->trading_pair == 'XAUUSD' ? 'selected' : '' }}>XAU/USD - Gold (Spot)</option>
                                        <option value="BTCUSD" {{ $config->trading_pair == 'BTCUSD' ? 'selected' : '' }}>BTC/USD - Bitcoin</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400 group-hover:text-white transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <p class="mt-3 text-xs text-gray-500 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    The AI will dedicate computational resources to monitoring this asset's microstructure.
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Risk & Protection -->
                    <div class="space-y-8">
                        
                        <!-- Risk Profile -->
                        <div class="bg-[#1a1a1a] rounded-3xl p-8 border border-white/5 shadow-xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-rose-500/5 rounded-full blur-[60px] -mr-10 -mt-10"></div>
                            
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3 relative z-10">
                                <div class="w-10 h-10 rounded-xl bg-rose-500/10 flex items-center justify-center border border-rose-500/20">
                                    <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                Risk Tolerance
                            </h3>

                            <div class="space-y-3 relative z-10">
                                @foreach(['Safe', 'Moderate', 'Aggressive', 'Capital Protection'] as $mode)
                                <label class="flex items-center justify-between p-4 rounded-xl border border-white/5 bg-white/[0.02] hover:bg-white/5 cursor-pointer transition-all group">
                                    <div class="flex items-center gap-4">
                                        <div class="relative flex items-center justify-center">
                                            <input type="radio" name="risk_mode" value="{{ $mode }}" class="peer sr-only" {{ $config->risk_mode == $mode ? 'checked' : '' }}>
                                            <div class="w-5 h-5 rounded-full border-2 border-gray-600 peer-checked:border-rose-500 peer-checked:bg-rose-500 transition-all"></div>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-gray-200 group-hover:text-white transition-colors">{{ $mode }}</span>
                                            <span class="block text-[10px] text-gray-500 font-medium uppercase tracking-wide mt-0.5">
                                                @if($mode == 'Safe') High Win Rate
                                                @elseif($mode == 'Moderate') Balanced
                                                @elseif($mode == 'Aggressive') Max Growth
                                                @else Preservation
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    @if($config->risk_mode == $mode)
                                        <span class="px-2 py-1 bg-rose-500/10 border border-rose-500/20 rounded text-[10px] font-bold text-rose-400">ACTIVE</span>
                                    @endif
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Auto-Pilot Settings -->
                        <div class="bg-[#1a1a1a] rounded-3xl p-8 border border-white/5 shadow-xl">
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center border border-purple-500/20">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                System Parameters
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="flex items-center justify-between group">
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-200">Dynamic SL/TP</h4>
                                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-bold mt-1">AI Managed Exits</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="auto_sl_tp" value="1" class="sr-only peer" {{ $config->auto_sl_tp ? 'checked' : '' }}>
                                        <div class="w-12 h-7 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-500 transition-colors"></div>
                                    </label>
                                </div>

                                <div class="w-full h-px bg-white/5"></div>

                                <div class="flex items-center justify-between group">
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-200">News Sentiment</h4>
                                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-bold mt-1">Avoid High Impact</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="news_reaction" value="1" class="sr-only peer" {{ $config->news_reaction ? 'checked' : '' }}>
                                        <div class="w-12 h-7 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-500 transition-colors"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-5 px-6 bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white font-bold text-lg rounded-2xl shadow-xl shadow-brand-500/20 transition-all duration-300 transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Configuration
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
