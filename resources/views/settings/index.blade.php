<x-app-layout>
    <div x-data="aiSettings()" class="p-6 max-w-7xl mx-auto space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white">AI Configuration</h2>
                <p class="text-gray-500 mt-2">Fine-tune your autonomous trading parameters.</p>
            </div>
            
            <!-- Master Switch -->
            <div class="flex items-center gap-4 bg-[#0a0a0a] border border-white/5 p-2 pr-6 rounded-full">
                <button @click="masterSwitch = !masterSwitch" 
                    :class="masterSwitch ? 'bg-brand-500 text-black' : 'bg-white/10 text-gray-500'"
                    class="relative w-14 h-8 rounded-full transition-colors duration-300 focus:outline-none">
                    <span :class="masterSwitch ? 'translate-x-7 bg-black' : 'translate-x-1 bg-gray-400'"
                        class="block w-6 h-6 rounded-full transform transition-transform duration-300"></span>
                </button>
                <div>
                    <span class="block text-xs text-gray-500 uppercase font-bold tracking-wider">Master Status</span>
                    <span :class="masterSwitch ? 'text-brand-500' : 'text-gray-400'" class="block font-bold text-sm" x-text="masterSwitch ? 'AI ACTIVE' : 'AI PAUSED'"></span>
                </div>
            </div>
        </div>

        <form action="#" method="POST" @submit.prevent="saveSettings">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Strategy & Assets -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Strategy Selection -->
                    <section>
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Trading Personality
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Scalper -->
                            <div @click="strategy = 'scalper'" 
                                 :class="strategy === 'scalper' ? 'border-brand-500 bg-brand-500/5 ring-1 ring-brand-500' : 'border-white/5 bg-[#0a0a0a] hover:border-brand-500/30'"
                                 class="cursor-pointer border rounded-2xl p-5 transition-all duration-200 group relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                                    <svg class="w-16 h-16 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                </div>
                                <h4 :class="strategy === 'scalper' ? 'text-brand-400' : 'text-white'" class="font-bold text-lg mb-2">The Scalper</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">High-frequency execution targeting small price movements.</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5">M1/M5</span>
                                    <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5">Aggressive</span>
                                </div>
                            </div>

                            <!-- Swing -->
                            <div @click="strategy = 'swing'"
                                 :class="strategy === 'swing' ? 'border-brand-500 bg-brand-500/5 ring-1 ring-brand-500' : 'border-white/5 bg-[#0a0a0a] hover:border-brand-500/30'"
                                 class="cursor-pointer border rounded-2xl p-5 transition-all duration-200 group relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                                    <svg class="w-16 h-16 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                </div>
                                <h4 :class="strategy === 'swing' ? 'text-brand-400' : 'text-white'" class="font-bold text-lg mb-2">Balanced Swing</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">Captures medium-term trends with moderate risk.</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5">H1/H4</span>
                                    <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5">Moderate</span>
                                </div>
                            </div>

                            <!-- Conservative -->
                            <div @click="strategy = 'conservative'"
                                 :class="strategy === 'conservative' ? 'border-brand-500 bg-brand-500/5 ring-1 ring-brand-500' : 'border-white/5 bg-[#0a0a0a] hover:border-brand-500/30'"
                                 class="cursor-pointer border rounded-2xl p-5 transition-all duration-200 group relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                                    <svg class="w-16 h-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                <h4 :class="strategy === 'conservative' ? 'text-brand-400' : 'text-white'" class="font-bold text-lg mb-2">The Fortress</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">Focuses on capital preservation and high-probability setups.</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5">D1</span>
                                    <span class="px-2 py-1 rounded bg-white/5 text-[10px] text-gray-400 border border-white/5">Low Risk</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Asset Whitelist -->
                    <section>
                         <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Asset Whitelist
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6 bg-[#0a0a0a] border border-white/5 rounded-2xl">
                             <template x-for="asset in assets" :key="asset.symbol">
                                <div @click="asset.active = !asset.active" 
                                     :class="asset.active ? 'bg-white/10 border-brand-500/50' : 'bg-transparent border-white/10 opacity-50'"
                                     class="cursor-pointer border rounded-xl p-3 flex items-center justify-between transition-all select-none">
                                    <div class="flex items-center gap-3">
                                        <div :class="asset.active ? 'bg-brand-500' : 'bg-gray-600'" class="w-2 h-2 rounded-full"></div>
                                        <span class="font-bold text-sm text-white" x-text="asset.symbol"></span>
                                    </div>
                                    <div :class="asset.active ? 'bg-brand-500' : 'bg-gray-700'" class="w-8 h-4 rounded-full relative transition-colors">
                                        <div :class="asset.active ? 'translate-x-4' : 'translate-x-0'" class="absolute top-0.5 left-0.5 w-3 h-3 bg-white rounded-full transition-transform"></div>
                                    </div>
                                </div>
                             </template>
                        </div>
                    </section>
                </div>

                <!-- Right Column: Risk Management -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-[#0a0a0a] border border-white/5 rounded-2xl p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            Risk Management
                        </h3>
                        
                        <!-- Risk Per Trade -->
                        <div class="mb-8">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm text-gray-400">Risk per Trade</label>
                                <span class="text-sm font-bold text-brand-500" x-text="riskPerTrade + '%'"></span>
                            </div>
                            <input type="range" x-model="riskPerTrade" min="0.5" max="5" step="0.5" class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-500">
                             <div class="flex justify-between mt-1 text-[10px] text-gray-600 font-mono">
                                <span>0.5%</span>
                                <span>2.5%</span>
                                <span>5.0%</span>
                            </div>
                        </div>

                        <!-- Max Open Trades -->
                        <div class="mb-8">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm text-gray-400">Max Open Trades</label>
                                <span class="text-sm font-bold text-white" x-text="maxTrades"></span>
                            </div>
                            <input type="range" x-model="maxTrades" min="1" max="10" step="1" class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-500">
                             <div class="flex justify-between mt-1 text-[10px] text-gray-600 font-mono">
                                <span>1</span>
                                <span>5</span>
                                <span>10</span>
                            </div>
                        </div>

                        <!-- Daily Loss Limit -->
                        <div class="mb-8">
                            <div class="flex justify-between mb-2">
                                <label class="text-sm text-gray-400">Daily Loss Limit</label>
                                <span class="text-sm font-bold text-red-400" x-text="'-' + dailyLoss + '%'"></span>
                            </div>
                            <input type="range" x-model="dailyLoss" min="2" max="20" step="1" class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-red-500">
                        </div>

                        <hr class="border-white/5 my-6">

                        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-brand-500 to-brand-600 text-black font-bold text-lg shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40 transform hover:-translate-y-1 transition-all duration-300">
                            Save Configuration
                        </button>
                        
                        <p x-show="saved" x-transition class="text-center text-green-500 text-sm mt-3 font-medium">Settings saved successfully!</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function aiSettings() {
            return {
                masterSwitch: true,
                strategy: 'swing',
                riskPerTrade: 1.5,
                maxTrades: 3,
                dailyLoss: 5,
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
                    setTimeout(() => this.saved = false, 3000);
                }
            }
        }
    </script>
</x-app-layout>
