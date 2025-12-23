<x-app-layout>
    <div class="h-[calc(100vh-5rem)] flex flex-col lg:flex-row gap-6 p-4 md:p-6" x-data="alphaTerminal()">
        
        <!-- Left Panel: Charting & Execution (Aurora Glass) -->
        <div class="flex-1 flex flex-col bg-[#0a0a0a]/80 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden relative shadow-[0_0_50px_-12px_rgba(124,58,237,0.1)]">
            
            <!-- Top Bar: Asset Selector & Stats -->
            <div class="h-16 border-b border-white/5 flex items-center justify-between px-6 bg-white/5 relative z-20">
                <div class="flex items-center gap-6">
                    <!-- Asset Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 group focus:outline-none">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-violet-500 to-fuchsia-500 flex items-center justify-center shadow-lg shadow-violet-500/20">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                            </div>
                            <div class="text-left">
                                <h2 class="text-white font-bol text-lg leading-none flex items-center gap-2">
                                    <span x-text="activeAsset"></span>
                                    <svg class="w-3 h-3 text-gray-500 group-hover:text-violet-400 transition-colors" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </h2>
                                <span class="text-[10px] text-gray-400 font-medium tracking-wider" x-text="assets[activeAsset].name"></span>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             class="absolute top-full left-0 mt-3 w-64 bg-[#111] border border-white/10 rounded-xl shadow-2xl py-2 z-50 backdrop-blur-xl">
                            <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Markets</div>
                            <template x-for="(details, symbol) in assets" :key="symbol">
                                <button @click="switchAsset(symbol); open = false" 
                                    class="w-full px-4 py-3 text-left hover:bg-white/5 transition-colors flex items-center justify-between group border-l-2 border-transparent hover:border-violet-500">
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm font-bold text-gray-300 group-hover:text-white" x-text="symbol"></span>
                                    </div>
                                    <span class="text-xs text-gray-500 group-hover:text-violet-400" x-text="details.price"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Live Ticker -->
                    <div class="hidden md:flex items-center gap-6 border-l border-white/10 pl-6">
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Market Price</p>
                            <p class="text-lg font-mono font-bold text-white tracking-tight" x-text="formatPrice(assets[activeAsset].price)"></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">24h Change</p>
                            <p class="text-sm font-mono font-bold text-emerald-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                +1.24%
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex items-center gap-3">
                    <div class="flex bg-black/40 rounded-lg p-1 border border-white/5">
                        <template x-for="tf in ['1M', '15M', '1H', '4H', '1D']">
                            <button class="px-3 py-1.5 text-xs rounded-md font-medium transition-all"
                                :class="activeTimeframe === tf ? 'bg-violet-600 text-white shadow-lg shadow-violet-500/25' : 'text-gray-500 hover:text-gray-300'"
                                @click="activeTimeframe = tf" x-text="tf"></button>
                        </template>
                    </div>
                    <button @click="fullscreen = !fullscreen" class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                    </button>
                </div>
            </div>

            <!-- Chart Area -->
            <div class="flex-1 relative w-full bg-[#050505]">
                <div id="alphaChart" class="absolute inset-0 w-full h-full"></div>
                
                <!-- Floating Order Panel -->
                <div class="absolute top-4 right-4 bg-[#111]/90 backdrop-blur-md border border-white/10 rounded-xl p-4 w-64 shadow-2xl z-10">
                    <div class="flex gap-2 mb-4">
                        <button class="flex-1 py-2 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-500 border border-emerald-500/20 rounded-lg text-sm font-bold transition-colors">BUY</button>
                        <button class="flex-1 py-2 bg-rose-500/10 hover:bg-rose-500/20 text-rose-500 border border-rose-500/20 rounded-lg text-sm font-bold transition-colors">SELL</button>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500">Lot Size</span>
                            <span class="text-white font-mono">1.00</span>
                        </div>
                        <input type="range" min="0.01" max="5.00" step="0.01" class="w-full h-1 bg-white/10 rounded-lg appearance-none cursor-pointer">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: PipFlow AI Chat (Collapsible) -->
        <div class="w-full lg:w-[400px] flex flex-col bg-[#0a0a0a]/80 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-[0_0_50px_-12px_rgba(6,182,212,0.1)] relative"
             x-show="!fullscreen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-10"
             x-transition:enter-end="opacity-100 translate-x-0">
            
            <!-- AI Header -->
            <div class="h-16 border-b border-white/5 flex items-center justify-between px-6 bg-white/5">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-2.5 h-2.5 rounded-full bg-cyan-400 shadow-[0_0_10px_#22d3ee] animate-pulse"></div>
                        <div class="absolute inset-0 w-2.5 h-2.5 rounded-full bg-cyan-400 animate-ping opacity-75"></div>
                    </div>
                    <h3 class="text-white font-bold tracking-tight">PipFlow AI</h3>
                </div>
                <div class="px-2 py-1 rounded bg-white/5 border border-white/5 text-[10px] font-mono text-cyan-400">ONLINE</div>
            </div>

            <!-- Chat Stream -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar" x-ref="chatStream">
                <!-- AI Greeting -->
                <div class="flex items-start gap-4 animate-fade-in-up">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-cyan-500/20">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-cyan-400 ml-1">PIPFLOW</span>
                        <div class="bg-white/5 border border-white/5 rounded-2xl rounded-tl-none p-4 text-sm text-gray-300 leading-relaxed shadow-sm">
                            <p>System Online. I am analyzing the <span class="text-white font-bold">XAUUSD</span> order flow. Latency is 12ms. What's your play?</p>
                        </div>
                    </div>
                </div>

                <template x-for="msg in messages" :key="msg.id">
                    <div class="flex items-start gap-4 animate-fade-in-up" :class="msg.isUser ? 'flex-row-reverse' : ''">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg"
                             :class="msg.isUser ? 'bg-white/10' : 'bg-gradient-to-br from-cyan-500 to-blue-600 shadow-cyan-500/20'">
                             <template x-if="msg.isUser">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                             </template>
                             <template x-if="!msg.isUser">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                             </template>
                        </div>
                        <div class="space-y-1 text-right" :class="msg.isUser ? 'items-end' : 'text-left items-start'">
                            <span class="text-[10px] font-bold ml-1" :class="msg.isUser ? 'text-gray-500 mr-1' : 'text-cyan-400'" x-text="msg.isUser ? 'YOU' : 'PIPFLOW'"></span>
                            <div class="p-4 text-sm leading-relaxed shadow-sm max-w-[280px]"
                                 :class="msg.isUser ? 'bg-violet-600 text-white rounded-2xl rounded-tr-none shadow-violet-500/20' : 'bg-white/5 border border-white/5 text-gray-300 rounded-2xl rounded-tl-none'">
                                <p x-text="msg.text"></p>
                            </div>
                        </div>
                    </div>
                </template>
                
                <div x-show="isTyping" class="flex items-start gap-4 animate-pulse">
                    <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" /></svg>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 bg-[#0a0a0a] border-t border-white/5">
                <form @submit.prevent="sendMessage" class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-violet-600 to-cyan-600 rounded-xl blur opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <input type="text" x-model="input" placeholder="Ask PipFlow..." 
                        class="w-full bg-[#111] border border-white/10 rounded-xl pl-4 pr-12 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-violet-500/50 focus:bg-[#151515] transition-all relative z-10">
                    <button type="submit" 
                        class="absolute right-2 top-2 p-1.5 rounded-lg bg-white/5 text-gray-400 hover:text-white hover:bg-violet-500 hover:shadow-lg hover:shadow-violet-500/50 transition-all z-20 disabled:opacity-50 disabled:cursor-not-allowed" 
                        :disabled="!input.trim()">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- Chart Engine Script -->
    <script>
        document.addEventListener('alpine:init', () => {
             Alpine.data('alphaTerminal', () => ({
                activeTimeframe: '1H',
                activeAsset: 'XAUUSD',
                fullscreen: false,
                assets: {
                    'XAUUSD': { name: 'Gold Spot', price: 2034.50 },
                    'BTCUSD': { name: 'Bitcoin', price: 64200.00 },
                    'EURUSD': { name: 'Euro/USD', price: 1.0850 },
                },
                messages: [],
                input: '',
                isTyping: false,
                chart: null,
                candleSeries: null,

                init() {
                    this.$nextTick(() => {
                        this.initChart();
                        this.generateMockData();
                    });
                },

                formatPrice(price) {
                    return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2 }).format(price);
                },

                switchAsset(symbol) {
                    this.activeAsset = symbol;
                    this.messages.push({
                        id: Date.now(),
                        text: `Switching analysis to ${symbol}. Loading technicals...`,
                        isUser: false
                    });
                    this.generateMockData();
                },

                initChart() {
                    const chartContainer = document.getElementById('alphaChart');
                    // Check if trading view lib is loaded, otherwise use fallback or wait
                    if(!window.createChart) return;

                    this.chart = window.createChart(chartContainer, {
                        layout: {
                            background: { color: '#050505' },
                            textColor: '#6b7280',
                            fontFamily: 'Inter, sans-serif',
                        },
                        grid: {
                            vertLines: { color: '#ffffff05' },
                            horzLines: { color: '#ffffff05' },
                        },
                        crosshair: {
                            mode: 1, // Magnet
                            vertLine: { color: '#8b5cf6', width: 1, style: 3, labelBackgroundColor: '#8b5cf6' },
                            horzLine: { color: '#8b5cf6', width: 1, style: 3, labelBackgroundColor: '#8b5cf6' },
                        },
                        timeScale: { borderColor: '#ffffff10' },
                        rightPriceScale: { borderColor: '#ffffff10' },
                    });

                    this.candleSeries = this.chart.addCandlestickSeries({
                        upColor: '#10b981',
                        downColor: '#ef4444', 
                        borderVisible: false,
                        wickUpColor: '#10b981',
                        wickDownColor: '#ef4444',
                    });

                    new ResizeObserver(entries => {
                        for (let entry of entries) {
                            const { width, height } = entry.contentRect;
                            this.chart.applyOptions({ width, height });
                        }
                    }).observe(chartContainer);
                },

                generateMockData() {
                    fetch(`/api/trading/history/${this.activeAsset}?timeframe=${this.activeTimeframe}`)
                        .then(response => response.json())
                        .then(data => {
                             if(data.success && this.candleSeries) {
                                 // Ensure data is sorted by time
                                 const sortedData = data.data.sort((a, b) => a.time - b.time);
                                 this.candleSeries.setData(sortedData);
                                 this.chart.timeScale().fitContent();
                             }
                        })
                        .catch(error => console.error('Error fetching data:', error));
                },

                sendMessage() {
                    if (!this.input.trim()) return;
                    this.messages.push({ id: Date.now(), text: this.input, isUser: true });
                    const q = this.input.toLowerCase();
                    this.input = '';
                    this.scrollToBottom();

                    this.isTyping = true;
                    setTimeout(() => {
                        this.isTyping = false;
                        let r = "I'm calculating optimal entries driven by recent volume spikes.";
                        if(q.includes('buy')) r = "Bullish momentum detected. RSI at 45. Consider long entries above 2038.00.";
                        if(q.includes('sell')) r = "Bearish divergence on H4. Pivot point at 2040.00 acts as strong resistance.";
                        this.messages.push({ id: Date.now(), text: r, isUser: false });
                        this.scrollToBottom();
                    }, 1000 + Math.random() * 1000);
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        this.$refs.chatStream.scrollTop = this.$refs.chatStream.scrollHeight;
                    });
                }
             }));
        });
    </script>
    
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</x-app-layout>
