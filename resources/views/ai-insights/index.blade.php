<x-app-layout>
    <div class="py-12 bg-rich-black-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">AI Model Insights</h2>
                <p class="text-gray-400">Deep dive into AI decision-making and performance analytics.</p>
            </div>

            <!-- Top Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Model Version -->
                <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Model Version</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['model_version'] }}</p>
                    </div>
                    <div class="text-blue-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>

                <!-- Accuracy Rate -->
                <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Accuracy Rate</p>
                        <p class="text-2xl font-bold text-green-500 mt-1">{{ $stats['accuracy_rate'] }}%</p>
                    </div>
                    <div class="text-green-500">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>

                <!-- Total Trades -->
                <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Trades</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_trades'] }}</p>
                    </div>
                    <div class="text-indigo-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>

                <!-- Success Rate -->
                <div class="bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Success Rate</p>
                        <p class="text-2xl font-bold text-green-500 mt-1">{{ $stats['success_rate'] }}%</p>
                    </div>
                    <div class="text-green-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Middle Metrics Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Market Conditions -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Market Conditions Monitoring</h3>
                    
                    <div class="space-y-6">
                        @foreach($marketConditions as $condition)
                        <div class="flex items-start justify-between p-4 rounded-xl bg-gray-50 border border-gray-100 hover:border-gray-200 transition-colors">
                            <div>
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-gray-900">{{ $condition['title'] }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide
                                        @if($condition['severity'] == 'high') bg-red-100 text-red-600
                                        @elseif($condition['severity'] == 'medium') bg-yellow-100 text-yellow-600
                                        @else bg-green-100 text-green-600 @endif">
                                        {{ $condition['severity'] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ $condition['description'] }}</p>
                            </div>
                            <div class="mt-1">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Model Performance -->
                <div class="bg-white rounded-2xl p-8 shadow-sm relative overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-900 mb-8">Model Performance</h3>
                    
                    <div class="space-y-8 relative z-10">
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Weekly Accuracy</span>
                            <span class="font-bold text-green-500">{{ $performance['weekly_accuracy'] }}%</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Risk Management</span>
                            <span class="font-bold text-blue-500">{{ $performance['risk_management'] }}%</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">News Integration</span>
                            <span class="font-bold text-indigo-500">{{ $performance['news_integration'] }}%</span>
                        </div>

                    </div>

                    <div class="mt-12 pt-6 border-t border-gray-100 text-xs text-gray-400">
                        Last model update: {{ $performance['last_update'] }}
                    </div>
                </div>
            </div>

            <!-- Recent AI Decisions -->
            <div class="bg-white rounded-2xl p-8 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Recent AI Decisions</h3>
                
                <div class="space-y-4">
                    @foreach($recentDecisions as $decision)
                    <div class="border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="font-bold text-gray-900">{{ $decision['pair'] }}</span>
                                    <span class="px-2 py-0.5 rounded textxs font-bold uppercase
                                        @if($decision['action'] == 'BUY') bg-green-100 text-green-600
                                        @elseif($decision['action'] == 'SELL') bg-red-100 text-red-600
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ $decision['action'] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">{{ $decision['rationale'] }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-xs text-gray-400">{{ $decision['time'] }}</span>
                                <span class="block text-xs font-bold text-yellow-500 mt-1">{{ $decision['confidence'] }}% Conf.</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
