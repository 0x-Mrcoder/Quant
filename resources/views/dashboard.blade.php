<x-app-layout>
    <div x-data="dashboard()">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">Command Center</h1>
                <p class="text-gray-500 text-sm mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Strategy Selector -->
                <div class="relative">
                    <select class="appearance-none bg-[#0a0a0a] border border-white/10 rounded-xl pl-4 pr-10 py-2.5 text-sm text-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-500/50">
                        <option>Safe Scalping (Low Risk)</option>
                        <option>Day Trading (Med Risk)</option>
                        <option>Swing (High Risk)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <!-- AI Toggle -->
                <button @click="toggleAi" 
                    class="flex items-center gap-3 px-5 py-2.5 rounded-xl border transition-all duration-300 shadow-lg"
                    :class="aiActive ? 'bg-brand-500/10 border-brand-500 text-brand-400 shadow-brand-500/10' : 'bg-red-500/10 border-red-500/50 text-red-400'">
                    <div class="relative w-3 h-3">
                        <div class="absolute inset-0 rounded-full animate-ping opacity-75" :class="aiActive ? 'bg-brand-500' : 'bg-red-500'"></div>
                        <div class="relative w-3 h-3 rounded-full" :class="aiActive ? 'bg-brand-500' : 'bg-red-500'"></div>
                    </div>
                    <span class="font-bold tracking-wide" x-text="aiActive ? 'AI ACTIVE' : 'AI DORMANT'"></span>
                </button>

                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 pl-4 border-l border-white/10 focus:outline-none group">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-white group-hover:text-brand-400 transition-colors">{{ Auth::user()->name }}</p>
                            @if(Auth::user()->subscription_plan === 'free')
                                <p class="text-xs text-gray-500">Free Plan</p>
                            @else
                                <p class="text-xs text-brand-500 font-bold uppercase tracking-wider">{{ str_replace('_', ' ', Auth::user()->subscription_plan) }}</p>
                            @endif
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 p-[1px] shadow-lg shadow-brand-500/20">
                            <div class="w-full h-full rounded-full bg-[#0a0a0a] flex items-center justify-center">
                                <span class="font-bold text-brand-500">{{ substr(Auth::user()->name, 0, 2) }}</span>
                            </div>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute right-0 mt-3 w-56 rounded-xl bg-[#0a0a0a] border border-white/10 shadow-2xl py-2 z-50" 
                         style="display: none;">
                        
                        <div class="px-4 py-3 border-b border-white/5 mb-2">
                            <p class="text-sm text-gray-400">Signed in as</p>
                            <p class="text-sm font-bold text-white truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-brand-400 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            User Profile
                        </a>

                        @if(Auth::user()->subscription_plan === 'free')
                            <a href="{{ route('subscription.index') }}" class="block px-4 py-2.5 mx-2 my-1 text-center rounded-lg bg-gradient-to-r from-brand-400 to-brand-600 text-black text-xs font-bold uppercase tracking-wider hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                Go Premium
                            </a>
                        @else
                            <a href="{{ route('subscription.manage') }}" class="block px-4 py-2.5 text-sm text-brand-400 hover:bg-white/5 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                Manage Subscription
                            </a>
                        @endif
                        
                        <a href="{{ route('settings.index') }}" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-white/5 hover:text-brand-400 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Settings
                        </a>

                        <div class="border-t border-white/5 my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widgets Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
            
            <!-- Left Column: Metrics -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Total Balance -->
                <div class="p-6 rounded-2xl bg-[#0a0a0a]/80 backdrop-blur border border-white/5 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/10 rounded-full blur-[50px] group-hover:bg-brand-500/20 transition-all"></div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Equity</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-white tracking-tight">$24,592.40</span>
                        <span class="text-sm text-green-400 bg-green-400/10 px-2 py-0.5 rounded-lg">+12.5%</span>
                    </div>
                </div>

                <!-- Win Rate & Risk -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-[#0a0a0a]/80 backdrop-blur border border-white/5 flex flex-col items-center justify-center relative overflow-hidden">
                        <div class="relative w-24 h-24 flex items-center justify-center">
                             <!-- Simple CSS Spinner for demo -->
                            <svg class="transform -rotate-90 w-24 h-24">
                                <circle cx="48" cy="48" r="36" stroke="currentColor" stroke-width="8" fill="transparent" class="text-gray-800" /> 
                                <circle cx="48" cy="48" r="36" stroke="currentColor" stroke-width="8" fill="transparent" stroke-dasharray="226" :stroke-dashoffset="226 - (226 * 78 / 100)" class="text-brand-500 transition-all duration-1000 ease-out" />
                            </svg>
                            <span class="absolute text-xl font-bold">78%</span>
                        </div>
                        <span class="text-gray-400 text-sm mt-3">Win Rate</span>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#0a0a0a]/80 backdrop-blur border border-white/5 flex flex-col items-center justify-center">
                         <div class="relative w-full h-24 flex items-end justify-center pb-2">
                            <!-- Gauge Arc -->
                            <div class="w-24 h-12 overflow-hidden relative">
                                <div class="w-24 h-24 rounded-full border-[8px] border-gray-800 border-b-transparent border-l-transparent transform rotate-45 absolute top-0 left-0"></div>
                                <div class="w-24 h-24 rounded-full border-[8px] border-green-500 border-b-transparent border-l-transparent transform rotate-45 absolute top-0 left-0" style="clip-path: polygon(0 0, 100% 0, 100% 40%, 0 0);"></div>
                            </div>
                            <span class="absolute bottom-2 text-xl font-bold">Low</span>
                         </div>
                         <span class="text-gray-400 text-sm">Risk Level</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Chart -->
            <div class="lg:col-span-8 p-6 rounded-2xl bg-[#0a0a0a]/80 backdrop-blur border border-white/5 relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-lg">Performance Curve</h3>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-xs rounded-lg bg-white/10 text-white">1D</button>
                        <button class="px-3 py-1 text-xs rounded-lg text-gray-500 hover:bg-white/5">1W</button>
                        <button class="px-3 py-1 text-xs rounded-lg text-gray-500 hover:bg-white/5">1M</button>
                    </div>
                </div>
                <div id="equityChart" class="w-full h-[300px]"></div>
            </div>
        </div>

        <!-- Bottom: AI Terminal & Trades -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- AI Terminal -->
            <div class="lg:col-span-2 p-6 rounded-2xl bg-[#0a0a0a] border border-brand-500/20 shadow-[0_0_30px_rgba(245,158,11,0.05)] relative overflow-hidden font-mono text-sm leading-relaxed">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-transparent via-brand-500 to-transparent opacity-50"></div>
                
                <h3 class="text-brand-400 font-bold mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-brand-500 rounded-full animate-pulse"></span>
                    AI Live Analysis
                </h3>
                
                <div class="space-y-2 h-[200px] overflow-y-auto custom-scrollbar" x-ref="terminal">
                    <template x-for="log in logs" :key="log.id">
                        <div class="flex gap-3">
                            <span class="text-gray-600" x-text="log.time"></span>
                            <span :class="log.color" x-text="log.message"></span>
                        </div>
                    </template>
                    <div class="flex gap-3 animate-pulse">
                        <span class="text-gray-600">></span>
                        <span class="text-brand-500">_</span>
                    </div>
                </div>
            </div>

            <!-- Recent Trades -->
            <div class="p-6 rounded-2xl bg-[#0a0a0a]/80 backdrop-blur border border-white/5">
                <h3 class="font-bold text-lg mb-4">Recent Trades</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-green-500/5 border border-green-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400 font-bold text-xs">BUY</div>
                            <div>
                                <p class="font-bold text-sm">EUR/USD</p>
                                <p class="text-xs text-gray-500">1.08420</p>
                            </div>
                        </div>
                        <span class="text-green-400 font-bold text-sm">+$124.50</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-red-500/5 border border-red-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center text-red-400 font-bold text-xs">SELL</div>
                            <div>
                                <p class="font-bold text-sm">XAU/USD</p>
                                <p class="text-xs text-gray-500">2032.10</p>
                            </div>
                        </div>
                        <span class="text-red-400 font-bold text-sm">-$42.10</span>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded-xl bg-green-500/5 border border-green-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400 font-bold text-xs">BUY</div>
                            <div>
                                <p class="font-bold text-sm">GBP/JPY</p>
                                <p class="text-xs text-gray-500">188.450</p>
                            </div>
                        </div>
                        <span class="text-green-400 font-bold text-sm">+$89.20</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function dashboard() {
            return {
                aiActive: true,
                logs: [],
                
                init() {
                    this.renderChart();
                    this.startTerminal();
                },

                toggleAi() {
                    this.aiActive = !this.aiActive;
                    this.addLog(this.aiActive ? 'System Manual Override: AI Activated.' : 'System Paused by User.', 'text-white');
                },

                addLog(message, color = 'text-gray-400') {
                    const time = new Date().toLocaleTimeString('en-US', { hour12: false, hour: 'numeric', minute: 'numeric', second: 'numeric' });
                    this.logs.push({ id: Date.now(), time: `[${time}]`, message: message, color: color });
                    this.$nextTick(() => {
                        this.$refs.terminal.scrollTop = this.$refs.terminal.scrollHeight;
                    });
                },

                startTerminal() {
                    const messages = [
                        { msg: 'Scanning market structure for XAUUSD...', color: 'text-blue-400' },
                        { msg: 'Detected liquidity void at 2035.50.', color: 'text-yellow-500' },
                        { msg: 'Analyzing Order Flow...', color: 'text-gray-400' },
                        { msg: 'RSI divergence confirmation on 15m timeframe.', color: 'text-green-400' },
                        { msg: 'Waiting for entry confirmation...', color: 'text-gray-400' }
                    ];
                    
                    let i = 0;
                    this.addLog('PipFlow Core System v2.1 Initialized.', 'text-brand-500');
                    
                    setInterval(() => {
                        if(this.aiActive) {
                            const item = messages[Math.floor(Math.random() * messages.length)];
                            this.addLog(item.msg, item.color);
                        }
                    }, 3500);
                },

                renderChart() {
                    if(!window.ApexCharts) return; // Wait for load
                    
                    const options = {
                        series: [{
                            name: 'Equity',
                            data: [10000, 10250, 10100, 10800, 11200, 11050, 12500, 13100, 12900, 14500, 15000, 24592]
                        }],
                        chart: {
                            type: 'area',
                            height: 300,
                            toolbar: { show: false },
                            background: 'transparent',
                            fontFamily: 'Nunito, sans-serif'
                        },
                        colors: ['#f59e0b'],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.4,
                                opacityTo: 0.05,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: { enabled: false },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                            labels: { style: { colors: '#666' } }
                        },
                        yaxis: {
                            labels: { style: { colors: '#666' } }
                        },
                        grid: {
                            borderColor: '#333',
                            strokeDashArray: 4,
                            yaxis: { lines: { show: true } },
                            xaxis: { lines: { show: false } },
                        },
                        theme: { mode: 'dark' }
                    };

                    const chart = new ApexCharts(document.querySelector("#equityChart"), options);
                    chart.render();
                }
            }
        }
    </script>
</x-app-layout>
