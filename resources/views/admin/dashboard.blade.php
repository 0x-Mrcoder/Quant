@extends('layouts.admin')

@section('content')
    <div class="space-y-8">

        <header class="mb-8 md:mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <p class="text-amber-500/60 uppercase tracking-widest text-xs font-bold mb-2">Command Center</p>
                <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">System Overview</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-3 py-1 rounded-full border border-green-500/20 bg-green-500/10 text-green-400 text-xs font-mono uppercase flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Live Feed
                </div>
                <div class="text-sm text-gray-500 font-mono">{{ now()->format('H:i:s UTC') }}</div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            <!-- Total Users -->
            <div class="group p-6 rounded-2xl bg-[#0a0a0a]/60 border border-white/5 hover:border-amber-500/30 transition-all backdrop-blur-md relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Users</p>
                <p class="text-3xl font-bold mt-2 text-white group-hover:text-amber-100 transition-colors">{{ number_format($stats['users']) }}</p>
                <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full w-[60%] bg-gradient-to-r from-gray-500 to-white"></div>
                </div>
            </div>

            <!-- Active Subs -->
            <div class="group p-6 rounded-2xl bg-[#0a0a0a]/60 border border-white/5 hover:border-amber-500/30 transition-all backdrop-blur-md relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Subs</p>
                <p class="text-3xl font-bold mt-2 text-amber-400 group-hover:text-amber-300 transition-colors">{{ number_format($stats['active_subs']) }}</p>
                <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full w-[40%] bg-gradient-to-r from-amber-600 to-amber-400"></div>
                </div>
            </div>

            <!-- Connections -->
            <div class="group p-6 rounded-2xl bg-[#0a0a0a]/60 border border-white/5 hover:border-emerald-500/30 transition-all backdrop-blur-md relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Connections</p>
                <p class="text-3xl font-bold mt-2 text-emerald-400 group-hover:text-emerald-300 transition-colors">{{ number_format($stats['connections']) }}</p>
                <div class="mt-4 h-1 w-full bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full w-[75%] bg-gradient-to-r from-emerald-600 to-emerald-400"></div>
                </div>
            </div>

            <!-- MRR -->
            <div class="group p-6 rounded-2xl bg-gradient-to-br from-amber-900/10 to-transparent border border-amber-500/20 hover:border-amber-500/40 transition-all backdrop-blur-md relative overflow-hidden">
                <div class="absolute inset-0 bg-amber-500/5 group-hover:bg-amber-500/10 transition-colors"></div>
                <p class="text-sm font-medium text-amber-500/70 uppercase tracking-wider relative z-10">Est. MRR</p>
                <p class="text-3xl font-bold mt-2 text-amber-200 relative z-10">${{ number_format($stats['revenue']) }}</p>
                <div class="mt-4 flex items-center gap-2 text-xs text-amber-400/60 relative z-10">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <span>+12.5% vs last month</span>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="lg:col-span-2 bg-[#0a0a0a]/60 border border-white/5 rounded-2xl p-6 backdrop-blur-md w-full min-w-0 relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white">Revenue Analytics</h3>
                    <select class="bg-black/40 border border-white/10 text-xs text-gray-400 rounded-lg px-2 py-1 focus:outline-none focus:border-amber-500">
                        <option>Last 30 Days</option>
                        <option>Last Quarter</option>
                        <option>Year to Date</option>
                    </select>
                </div>
                <div class="w-full overflow-hidden relative z-0">
                    <div id="revenueChart" class="w-full"></div>
                </div>
            </div>

            <!-- User Growth / Infrastructure -->
            <div class="bg-[#0a0a0a]/60 border border-white/5 rounded-2xl p-6 backdrop-blur-md flex flex-col">
                <h3 class="text-lg font-bold text-white mb-6">Infrastructure</h3>
                
                <div class="space-y-4 flex-1">
                    <div class="p-4 rounded-xl bg-black/40 border border-white/5 flex items-center justify-between group hover:border-green-500/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">MetaApi</p>
                                <p class="text-xs text-gray-500">99.9% Uptime</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-green-500">OK</span>
                    </div>

                    <div class="p-4 rounded-xl bg-black/40 border border-white/5 flex items-center justify-between group hover:border-green-500/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">Deriv WS</p>
                                <p class="text-xs text-gray-500">45ms Latency</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-green-500">OK</span>
                    </div>

                    <div class="p-4 rounded-xl bg-black/40 border border-white/5 flex items-center justify-between group hover:border-amber-500/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-500/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">PipFlow AI</p>
                                <p class="text-xs text-gray-500">Scaling Up</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-amber-500">BUSY</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-[#0a0a0a]/60 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-md">
            <div class="p-6 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Recent Registrations</h3>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-amber-500 hover:text-amber-400 font-medium">View All &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5 text-xs text-gray-400 uppercase tracking-wider">
                            <th class="p-4 font-medium">User</th>
                            <th class="p-4 font-medium">Status</th>
                            <th class="p-4 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <!-- We can inject recent users here later, using static for logic now -->
                         <tr class="hover:bg-white/5 transition">
                            <td class="p-4 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xs font-bold">A</div>
                                <span class="font-medium">Alex Quant</span>
                            </td>
                            <td class="p-4"><span class="px-2 py-1 rounded text-xs bg-green-500/10 text-green-500">Active</span></td>
                            <td class="p-4 text-gray-500 text-sm">2 hours ago</td>
                        </tr>
                         <tr class="hover:bg-white/5 transition">
                            <td class="p-4 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-purple-500/20 text-purple-400 flex items-center justify-center text-xs font-bold">J</div>
                                <span class="font-medium">John Doe</span>
                            </td>
                            <td class="p-4"><span class="px-2 py-1 rounded text-xs bg-amber-500/10 text-amber-500">Pending</span></td>
                            <td class="p-4 text-gray-500 text-sm">5 hours ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="module">
        import ApexCharts from 'apexcharts';

        // Revenue Chart Configuration
        const options = {
            series: [{
                name: 'Revenue',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 150, 200, 230]
            }],
            chart: {
                height: 300,
                type: 'area', // Area chart for "Area" effect
                toolbar: { show: false },
                background: 'transparent'
            },
            colors: ['#f59e0b'], // Amber-500
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.0,
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
                labels: { style: { colors: '#9ca3af' } },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { colors: '#9ca3af' }, formatter: (val) => '$' + val },
            },
            grid: {
                borderColor: '#ffffff10', // white/5
                strokeDashArray: 4,
            },
            theme: { mode: 'dark' }
        };

        const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();

        // Force resize to ensure correct width calculation
        window.dispatchEvent(new Event('resize'));
        
        // Dynamic re-render on side-bar toggle or window resize events if needed
        document.addEventListener('alpine:init', () => {
             Alpine.store('sidebar', {
                 open: false,
                 toggle() { 
                     this.open = ! this.open;
                     setTimeout(() => window.dispatchEvent(new Event('resize')), 300);
                 }
             })
        });
    </script>
@endsection