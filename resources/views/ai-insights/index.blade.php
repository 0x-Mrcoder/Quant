<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">AI Model Insights</h2>
                    <p class="text-gray-400">Deep dive into AI decision-making and performance analytics.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-emerald-400 text-xs font-bold uppercase tracking-wider animate-pulse">
                        ● Live Inference
                    </span>
                    <span class="text-xs text-gray-500 font-mono">{{ now()->format('H:i:s UTC') }}</span>
                </div>
            </div>

            <!-- Top Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Model Version -->
                <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-all group-hover:bg-blue-500/20"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Model Version</p>
                            <p class="text-2xl font-bold text-white mt-2">{{ $stats['model_version'] }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Accuracy Rate -->
                <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-6 relative overflow-hidden group">
                     <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-all group-hover:bg-emerald-500/20"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Accuracy Rate</p>
                            <p class="text-2xl font-bold text-emerald-400 mt-2">{{ $stats['accuracy_rate'] }}%</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center">
                             <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Total Trades -->
                <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-6 relative overflow-hidden group">
                     <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-all group-hover:bg-indigo-500/20"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Trades</p>
                            <p class="text-2xl font-bold text-white mt-2">{{ $stats['total_trades'] }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Success Rate -->
                <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-6 relative overflow-hidden group">
                     <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-all group-hover:bg-amber-500/20"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Success Rate</p>
                            <p class="text-2xl font-bold text-amber-400 mt-2">{{ $stats['success_rate'] }}%</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Metrics Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Market Conditions -->
                <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-8 relative overflow-hidden">
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                        Market Conditions Monitoring
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($marketConditions as $condition)
                        <div class="group flex items-start justify-between p-4 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-white/10 transition-all">
                            <div>
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-white">{{ $condition['title'] }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide
                                        @if($condition['severity'] == 'high') bg-red-500/10 text-red-400 border border-red-500/20
                                        @elseif($condition['severity'] == 'medium') bg-amber-500/10 text-amber-400 border border-amber-500/20
                                        @else bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 @endif">
                                        {{ $condition['severity'] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-400 mt-1group-hover:text-gray-300 transition-colors">{{ $condition['description'] }}</p>
                            </div>
                            <div class="mt-1 opacity-50 group-hover:opacity-100 transition-opacity">
                                @if($condition['severity'] == 'high')
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                @else
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Model Performance -->
                <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-violet-500/5 rounded-full blur-3xl -mr-20 -mt-20"></div>
                    
                    <h3 class="text-lg font-bold text-white mb-8 relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Performance Metrics
                    </h3>
                    
                    <div class="space-y-8 relative z-10">
                        
                        <!-- Weekly Accuracy Bar -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 font-medium text-sm">Weekly Accuracy</span>
                                <span class="font-bold text-emerald-400">{{ $performance['weekly_accuracy'] }}%</span>
                            </div>
                            <div class="w-full bg-white/5 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-600 to-emerald-400 h-2 rounded-full" style="width: {{ $performance['weekly_accuracy'] }}%"></div>
                            </div>
                        </div>
                        
                        <!-- Risk Management Bar -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 font-medium text-sm">Risk Management Efficiency</span>
                                <span class="font-bold text-blue-400">{{ $performance['risk_management'] }}%</span>
                            </div>
                            <div class="w-full bg-white/5 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-600 to-blue-400 h-2 rounded-full" style="width: {{ $performance['risk_management'] }}%"></div>
                            </div>
                        </div>

                        <!-- News Integration Bar -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 font-medium text-sm">News Integration Score</span>
                                <span class="font-bold text-indigo-400">{{ $performance['news_integration'] }}%</span>
                            </div>
                            <div class="w-full bg-white/5 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 h-2 rounded-full" style="width: {{ $performance['news_integration'] }}%"></div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 pt-6 border-t border-white/5 flex items-center gap-2">
                         <div class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </div>
                        <p class="text-xs text-gray-500 font-mono">Last model update: {{ $performance['last_update'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent AI Decisions -->
            <div class="bg-[#1a1a1a] border border-white/5 rounded-2xl p-8 relative overflow-hidden">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Recent Reasoning Engine Logs
                </h3>
                
                <div class="space-y-4">
                    @foreach($recentDecisions as $decision)
                    <div class="border-b border-white/5 last:border-0 pb-4 last:pb-0 hover:bg-white/5 p-3 rounded-xl transition-colors -mx-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="font-bold text-white text-lg">{{ $decision['pair'] }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide
                                        @if($decision['action'] == 'BUY') bg-emerald-500/20 text-emerald-400 border border-emerald-500/20
                                        @elseif($decision['action'] == 'SELL') bg-red-500/20 text-red-400 border border-red-500/20
                                        @else bg-gray-500/20 text-gray-400 border border-gray-500/20 @endif">
                                        {{ $decision['action'] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-400 mt-1 leading-relaxed"><span class="text-gray-500 font-mono text-xs mr-2">Analysis:</span>{{ $decision['rationale'] }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-xs text-gray-500 font-mono">{{ $decision['time'] }}</span>
                                <div class="flex items-center justify-end gap-1 mt-1">
                                    <div class="h-1.5 w-16 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-500" style="width: {{ $decision['confidence'] }}%"></div>
                                    </div>
                                    <span class="block text-[10px] font-bold text-amber-500">{{ $decision['confidence'] }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
