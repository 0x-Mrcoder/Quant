<x-app-layout>
    <div class="h-[calc(100vh-2rem)] flex flex-col lg:flex-row gap-6 p-6" x-data="alphaTerminal()">
        
        <!-- Left Panel: Charting Engine -->
        <div class="flex-1 flex flex-col bg-[#0a0a0a] border border-white/5 rounded-2xl overflow-hidden relative group">
            
            <!-- Chart Header -->
            <div class="h-16 border-b border-white/5 flex items-center justify-between px-6 bg-[#0a0a0a] z-10">
                <div class="flex items-center gap-4">
                <div class="flex items-center gap-4 relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex flex-col text-left group focus:outline-none">
                        <h2 class="text-white font-bold text-lg flex items-center gap-2 group-hover:text-brand-400 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <span x-text="activeAsset"></span>
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </h2>
                        <span class="text-xs text-gray-500" x-text="assets[activeAsset].name"></span>
                    </button>
                    
                    <!-- Asset Dropdown -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute top-full left-0 mt-2 w-56 bg-[#0a0a0a] border border-white/10 rounded-xl shadow-2xl py-2 z-50">
                        <template x-for="(details, symbol) in assets" :key="symbol">
                            <button @click="switchAsset(symbol); open = false" 
                                class="w-full px-4 py-2.5 text-left hover:bg-white/5 transition-colors flex items-center justify-between group">
                                <div>
                                    <p class="text-sm font-bold text-white group-hover:text-brand-400" x-text="symbol"></p>
                                    <p class="text-[10px] text-gray-500" x-text="details.name"></p>
                                </div>
                                <span x-show="activeAsset === symbol" class="text-brand-500">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                            </button>
                        </template>
                    </div>

                    <div class="h-8 w-[1px] bg-white/10"></div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-[10px]">PRICE</span>
                            <span class="text-white font-mono font-bold">2,034.50</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-[10px]">24H CHG</span>
                            <span class="text-green-500 font-mono font-bold">+1.25%</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Fullscreen Toggle -->
                    <button @click="fullscreen = !fullscreen" class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors" :title="fullscreen ? 'Exit Fullscreen' : 'Maximize Chart'">
                        <template x-if="!fullscreen">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                        </template>
                        <template x-if="fullscreen">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </template>
                    </button>

                    <!-- Timeframes -->
                    <div class="flex bg-white/5 rounded-lg p-1">
                        <template x-for="tf in ['M1', 'M5', 'M15', 'H1', 'H4', 'D1']">
                            <button class="px-3 py-1 text-xs rounded-md transition-colors"
                                :class="activeTimeframe === tf ? 'bg-brand-500 text-black font-bold shadow-lg' : 'text-gray-500 hover:text-white'"
                                @click="activeTimeframe = tf" x-text="tf"></button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Chart Container -->
            <div id="alphaChart" class="flex-1 w-full bg-[#0a0a0a] relative"></div>
            
            <!-- AI Overlay Markers (Demo) -->
            <div class="absolute bottom-6 left-6 flex gap-2 z-20">
                <div class="px-3 py-1.5 rounded-lg bg-green-500/20 border border-green-500/50 text-green-400 text-xs font-bold backdrop-blur flex items-center gap-2 animate-bounce">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    STRONG BUY SIGNAL
                </div>
            </div>
        </div>

        <!-- Right Panel: AI Chat Cortex -->
        <div class="w-full lg:w-[400px] h-full flex flex-col bg-[#0a0a0a] border border-white/5 rounded-2xl overflow-hidden relative" 
             x-show="!fullscreen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-10"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-10">
            <!-- Header -->
            <div class="h-16 border-b border-white/5 flex items-center justify-between px-6 bg-[#0a0a0a] z-10">
                <h3 class="text-white font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    Quant Chat
                </h3>
                <span class="w-2 h-2 rounded-full bg-brand-500 shadow-[0_0_10px_#eab308]"></span>
            </div>

            <!-- Chat Stream -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar" x-ref="chatStream">
                <!-- Welcome Message -->
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-brand-500/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div class="bg-white/5 rounded-2xl rounded-tl-none p-3 max-w-[85%] text-sm text-gray-300 leading-relaxed border border-white/5">
                        <p>Welcome to the <strong class="text-white">Alpha Terminal</strong>. I am monitoring XAUUSD real-time. Ask me about trends, support levels, or execution strategies.</p>
                    </div>
                </div>

                <template x-for="msg in messages" :key="msg.id">
                    <div class="flex items-start gap-3" :class="msg.isUser ? 'flex-row-reverse' : ''">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
                             :class="msg.isUser ? 'bg-white/10' : 'bg-brand-500/10'">
                             <template x-if="msg.isUser">
                                <span class="text-xs font-bold text-white">ME</span>
                             </template>
                             <template x-if="!msg.isUser">
                                <svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                             </template>
                        </div>
                        <div class="p-3 max-w-[85%] text-sm leading-relaxed border"
                             :class="msg.isUser ? 'bg-brand-500 text-black font-medium rounded-2xl rounded-tr-none border-brand-500 shadow-lg shadow-brand-500/10' : 'bg-white/5 rounded-2xl rounded-tl-none text-gray-300 border-white/5'">
                            <p x-text="msg.text"></p>
                        </div>
                    </div>
                </template>
                
                <div x-show="isTyping" class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-brand-500/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div class="flex gap-1 items-center h-8">
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce delay-100"></span>
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full animate-bounce delay-200"></span>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 bg-[#0a0a0a] border-t border-white/5">
                <form @submit.prevent="sendMessage" class="relative">
                    <input type="text" x-model="input" placeholder="Ask AI about the market..." 
                        class="w-full bg-white/5 border border-white/10 rounded-xl pl-4 pr-12 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-brand-500/50 focus:ring-1 focus:ring-brand-500/50 transition-all">
                    <button type="submit" class="absolute right-2 top-2 p-1.5 rounded-lg bg-brand-500 hover:bg-brand-400 text-black transition-colors disabled:opacity-50" :disabled="!input.trim()">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
             Alpine.data('alphaTerminal', () => ({
                activeTimeframe: 'H1',
                activeAsset: 'XAUUSD',
                fullscreen: false,
                assets: {
                    'XAUUSD': { name: 'Gold vs US Dollar', price: 2034.50 },
                    'EURUSD': { name: 'Euro vs US Dollar', price: 1.0950 },
                    'GBPUSD': { name: 'British Pound vs US Dollar', price: 1.2750 },
                    'BTCUSD': { name: 'Bitcoin vs US Dollar', price: 42500.00 },
                    'US30':   { name: 'US Wall Street 30', price: 37500.00 }
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

                switchAsset(symbol) {
                    this.activeAsset = symbol;
                    this.generateMockData();
                },

                initChart() {
                    if(!window.createChart) return;

                    const chartContainer = document.getElementById('alphaChart');
                    this.chart = window.createChart(chartContainer, {
                        layout: {
                            background: { color: '#0a0a0a' },
                            textColor: '#9ca3af',
                            fontFamily: 'Nunito, sans-serif',
                        },
                        grid: {
                            vertLines: { color: 'rgba(255, 255, 255, 0.05)' },
                            horzLines: { color: 'rgba(255, 255, 255, 0.05)' },
                        },
                        crosshair: {
                            mode: 0, // Normal
                        },
                        timeScale: {
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            timeVisible: true,
                        },
                        rightPriceScale: {
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                        },
                    });

                    this.candleSeries = this.chart.addCandlestickSeries({
                        upColor: '#10b981',
                        downColor: '#ef4444',
                        borderUpColor: '#10b981',
                        borderDownColor: '#ef4444',
                        wickUpColor: '#10b981',
                        wickDownColor: '#ef4444',
                    });

                    // Resize Observer
                    new ResizeObserver(entries => {
                        for (let entry of entries) {
                            const { width, height } = entry.contentRect;
                            this.chart.applyOptions({ width, height });
                        }
                    }).observe(chartContainer);
                },

                generateMockData() {
                    // Generate 100 candle points
                    let data = [];
                    let time = new Date(Date.now() - 100 * 60 * 60 * 1000).getTime() / 1000;
                    let price = this.assets[this.activeAsset].price;

                    for (let i = 0; i < 150; i++) {
                        let volatility = price * 0.002; // 0.2% volatility
                        let open = price;
                        let close = price + (Math.random() - 0.5) * volatility;
                        let high = Math.max(open, close) + Math.random() * (volatility * 0.5);
                        let low = Math.min(open, close) - Math.random() * (volatility * 0.5);
                        
                        data.push({ time: time, open, high, low, close });
                        
                        time += 3600; // 1 hour
                        price = close;
                    }
                    this.candleSeries.setData(data);
                    this.chart.timeScale().fitContent();
                },

                sendMessage() {
                    if (!this.input.trim()) return;

                    // Add user message
                    this.messages.push({ id: Date.now(), text: this.input, isUser: true });
                    const userQuery = this.input.toLowerCase();
                    this.input = '';
                    this.scrollToBottom();

                    // Simulate AI Response
                    this.isTyping = true;
                    setTimeout(() => {
                        this.isTyping = false;
                        let response = "I'm analyzing the latest price action on XAUUSD. Volume is currently low, waiting for the NY session open.";
                        
                        if(userQuery.includes('buy') || userQuery.includes('long')) {
                            response = "Technical indicators suggest a STRONG BUY. RSI is showing hidden bullish divergence at the 2032.00 support level.";
                        } else if (userQuery.includes('sell') || userQuery.includes('short')) {
                            response = "I would advise caution on shorts. We are rejecting a key demand zone. Wait for a break below 2028.00 before entering.";
                        } else if (userQuery.includes('target') || userQuery.includes('tp')) {
                            response = "Immediate upside target is 2045.50 (Daily High). Extended targets at 2052.00.";
                        }

                        this.messages.push({ id: Date.now(), text: response, isUser: false });
                        this.scrollToBottom();
                    }, 1500);
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        this.$refs.chatStream.scrollTop = this.$refs.chatStream.scrollHeight;
                    });
                }
             }));
        });
    </script>
</x-app-layout>
