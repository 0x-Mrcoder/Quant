<x-app-layout>
    <div x-data="aiSettings()" class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">AI Configuration Matrix</h2>
                    <p class="text-gray-400">Fine-tune the neural network parameters for your autonomous agent.</p>
                </div>
                
                <!-- Master Switch -->
                <div class="bg-[#1a1a1a] border border-white/5 p-2 pr-6 rounded-2xl flex items-center gap-4 shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-brand-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <button @click="masterSwitch = !masterSwitch" 
                        :class="masterSwitch ? 'bg-brand-500 shadow-[0_0_20px_rgba(99,102,241,0.4)]' : 'bg-gray-800'"
                        class="relative w-16 h-9 rounded-xl transition-all duration-300 focus:outline-none z-10">
                        <span :class="masterSwitch ? 'translate-x-8 bg-white' : 'translate-x-1 bg-gray-500'"
                            class="block w-7 h-7 rounded-lg transform transition-transform duration-300 shadow-sm"></span>
                    </button>
                    <div class="z-10">
                        <span class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest leading-tight">System Status</span>
                        <div class="flex items-center gap-2">
                            <span :class="masterSwitch ? 'bg-brand-500 animate-pulse' : 'bg-gray-600'" class="w-2 h-2 rounded-full"></span>
                            <span :class="masterSwitch ? 'text-brand-400' : 'text-gray-400'" class="block font-bold text-sm tracking-wide" x-text="masterSwitch ? 'ONLINE' : 'OFFLINE'"></span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" @submit.prevent="saveSettings">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Strategy & Assets -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Strategy Selection -->
                        <section>
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-white flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center border border-purple-500/20">
                                        <svg class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                                    </div>
                                    Trading Personality
                                </h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Scalper -->
                                <div @click="strategy = 'scalper'" 
                                     :class="strategy === 'scalper' ? 'border-brand-500 bg-brand-500/10 shadow-[0_0_30px_rgba(99,102,241,0.1)]' : 'border-white/5 bg-[#1a1a1a] hover:bg-white/5'"
                                     class="cursor-pointer border rounded-2xl p-6 transition-all duration-300 group relative overflow-hidden">
                                     <div class="absolute top-0 right-0 w-20 h-20 bg-brand-500/10 rounded-full blur-2xl -mr-6 -mt-6 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <h4 :class="strategy === 'scalper' ? 'text-brand-400' : 'text-gray-200'" class="font-bold text-lg mb-2 flex items-center gap-2">
                                        The Scalper
                                    </h4>
                                    <p class="text-xs text-gray-400 leading-relaxed mb-4 min-h-[40px]">High-frequency execution targeting micro-structure inefficiencies.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5 font-mono">M1/M5</span>
                                        <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5 uppercase font-bold">Aggressive</span>
                                    </div>
                                </div>

                                <!-- Swing -->
                                <div @click="strategy = 'swing'"
                                     :class="strategy === 'swing' ? 'border-blue-500 bg-blue-500/10 shadow-[0_0_30px_rgba(59,130,246,0.1)]' : 'border-white/5 bg-[#1a1a1a] hover:bg-white/5'"
                                     class="cursor-pointer border rounded-2xl p-6 transition-all duration-300 group relative overflow-hidden">
                                     <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full blur-2xl -mr-6 -mt-6 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <h4 :class="strategy === 'swing' ? 'text-blue-400' : 'text-gray-200'" class="font-bold text-lg mb-2">Balanced Swing</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed mb-4 min-h-[40px]">Captures reliable medium-term trend continuations.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5 font-mono">H1/H4</span>
                                        <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5 uppercase font-bold">Moderate</span>
                                    </div>
                                </div>

                                <!-- Conservative -->
                                <div @click="strategy = 'conservative'"
                                     :class="strategy === 'conservative' ? 'border-emerald-500 bg-emerald-500/10 shadow-[0_0_30px_rgba(16,185,129,0.1)]' : 'border-white/5 bg-[#1a1a1a] hover:bg-white/5'"
                                     class="cursor-pointer border rounded-2xl p-6 transition-all duration-300 group relative overflow-hidden">
                                     <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-500/10 rounded-full blur-2xl -mr-6 -mt-6 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <h4 :class="strategy === 'conservative' ? 'text-emerald-400' : 'text-gray-200'" class="font-bold text-lg mb-2">The Fortress</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed mb-4 min-h-[40px]">Prioritizes capital preservation with institutional controls.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5 font-mono">D1</span>
                                        <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5 uppercase font-bold">Safe</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Asset Whitelist -->
                        <section>
                             <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20">
                                    <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                </div>
                                Asset Whitelist
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6 bg-[#1a1a1a] border border-white/5 rounded-3xl relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                                 <template x-for="asset in assets" :key="asset.symbol">
                                    <div @click="asset.active = !asset.active" 
                                         :class="asset.active ? 'bg-white/5 border-brand-500/50 shadow-[0_0_15px_rgba(99,102,241,0.1)]' : 'bg-transparent border-white/5 opacity-40 hover:opacity-100'"
                                         class="cursor-pointer border rounded-2xl p-4 flex items-center justify-between transition-all duration-300 select-none group">
                                        <div class="flex items-center gap-3">
                                            <div :class="asset.active ? 'bg-brand-500 shadow-lg shadow-brand-500/50' : 'bg-gray-700'" class="w-2 h-2 rounded-full transition-all"></div>
                                            <span :class="asset.active ? 'text-white' : 'text-gray-400'" class="font-bold text-sm tracking-wide" x-text="asset.symbol"></span>
                                        </div>
                                    </div>
                                 </template>
                            </div>
                        </section>
                        
                        <!-- Fundamental Analysis -->
                        <section>
                             <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center border border-amber-500/20">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                                </div>
                                Fundamental Intelligence
                            </h3>
                            <div class="bg-[#1a1a1a] border border-white/5 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
                                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-amber-500/5 rounded-full blur-[80px]"></div>
                                
                                <div class="flex-1 relative z-10">
                                    <h4 class="font-bold text-white text-lg mb-2">Macro-Economic Integration</h4>
                                    <p class="text-gray-400 text-sm leading-relaxed max-w-lg">
                                        Enables the AI to parse global economic calendars (NFP, FOMC, CPI). It will automatically widen stops or pause trading during high-volatility news events.
                                    </p>
                                </div>
                                
                                <!-- Fundamental Toggle -->
                                 <div class="flex items-center gap-4 relative z-10">
                                    <span :class="fundamentalNews ? 'text-amber-400 shadow-amber-500/50' : 'text-gray-600'" class="font-bold text-xs uppercase tracking-widest transition-colors" x-text="fundamentalNews ? 'ACTIVE' : 'DISABLED'"></span>
                                    <button type="button" @click="fundamentalNews = !fundamentalNews" 
                                        :class="fundamentalNews ? 'bg-amber-500' : 'bg-gray-800'"
                                        class="relative w-16 h-9 rounded-full transition-all duration-300 focus:outline-none shadow-xl">
                                        <span :class="fundamentalNews ? 'translate-x-8 bg-black' : 'translate-x-1 bg-gray-400'"
                                            class="block w-7 h-7 rounded-full transform transition-transform duration-300 shadow-sm border border-white/10"></span>
                                    </button>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right Column: Risk Management -->
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-[#1a1a1a] border border-white/5 rounded-3xl p-8 sticky top-6 shadow-2xl relative overflow-hidden">
                             <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/5 rounded-full blur-[50px] -mr-10 -mt-10"></div>
                            
                            <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3 relative z-10">
                                <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center border border-red-500/20">
                                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                </div>
                                Risk Guards
                            </h3>
                            
                            <!-- Risk Per Trade -->
                            <div class="mb-10 relative z-10">
                                <div class="flex justify-between mb-4">
                                    <label class="text-sm font-bold text-gray-400 uppercase tracking-wide">Risk per Trade</label>
                                    <span class="text-lg font-bold text-brand-400 font-mono" x-text="riskPerTrade + '%'"></span>
                                </div>
                                <input type="range" x-model="riskPerTrade" min="0.5" max="5" step="0.5" class="w-full h-2 bg-gray-800 rounded-lg appearance-none cursor-pointer accent-brand-500 hover:accent-brand-400 transition-all">
                                 <div class="flex justify-between mt-2 text-[10px] text-gray-600 font-mono font-bold">
                                    <span>CONSERVATIVE (0.5%)</span>
                                    <span>AGGRESSIVE (5.0%)</span>
                                </div>
                            </div>

                            <!-- Max Open Trades -->
                            <div class="mb-10 relative z-10">
                                <div class="flex justify-between mb-4">
                                    <label class="text-sm font-bold text-gray-400 uppercase tracking-wide">Max Exposure</label>
                                    <span class="text-lg font-bold text-white font-mono" x-text="maxTrades + ' pos'"></span>
                                </div>
                                <input type="range" x-model="maxTrades" min="1" max="10" step="1" class="w-full h-2 bg-gray-800 rounded-lg appearance-none cursor-pointer accent-brand-500 hover:accent-brand-400 transition-all">
                                 <div class="flex justify-between mt-2 text-[10px] text-gray-600 font-mono font-bold">
                                    <span>FOCUSED (1)</span>
                                    <span>DIVERSIFIED (10)</span>
                                </div>
                            </div>

                            <!-- Daily Loss Limit -->
                            <div class="mb-10 relative z-10">
                                <div class="flex justify-between mb-4">
                                    <label class="text-sm font-bold text-gray-400 uppercase tracking-wide">Daily Loss Limit</label>
                                    <span class="text-lg font-bold text-red-400 font-mono" x-text="'-' + dailyLoss + '%'"></span>
                                </div>
                                <input type="range" x-model="dailyLoss" min="2" max="20" step="1" class="w-full h-2 bg-gray-800 rounded-lg appearance-none cursor-pointer accent-red-500 hover:accent-red-400 transition-all">
                                <div class="mt-2 text-[10px] text-red-500/60 font-mono text-right">FORCE SHUTDOWN AT LIMIT</div>
                            </div>

                            <div class="h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent my-8"></div>

                            <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-brand-600 to-indigo-600 text-white font-bold text-lg shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40 hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                <span class="relative flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                    Apply Configuration
                                </span>
                            </button>
                            
                            <div x-show="saved" x-transition.opacity.duration.500ms class="absolute bottom-4 left-0 right-0 text-center">
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/10 border border-green-500/20 rounded-full text-green-400 text-xs font-bold">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Saved Successfully
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Inline Alpine Data tailored for new UI features -->
    <script>
        function aiSettings() {
            return {
                masterSwitch: true,
                strategy: 'swing',
                riskPerTrade: 1.5,
                maxTrades: 3,
                dailyLoss: 5,
                fundamentalNews: true,
                saved: false,
                assets: [
                    { symbol: 'XAUUSD', active: true },
                    { symbol: 'EURUSD', active: true },
                    { symbol: 'GBPUSD', active: false },
                    { symbol: 'BTCUSD', active: true },
                    { symbol: 'US30', active: false },
                    { symbol: 'NAS100', active: true },
                    { symbol: 'USDJPY', active: false },
                    { symbol: 'ETHUSD', active: false },
                ],
                
                saveSettings() {
                    // Logic to send to backend would go here
                    this.saved = true;
                    // Trigger haptic feedback visually or actually if feasible
                    setTimeout(() => this.saved = false, 3000);
                }
            }
        }
    </script>
</x-app-layout>
