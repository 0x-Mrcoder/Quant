<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#0a0a0a] border border-brand-500/20 rounded-2xl overflow-hidden relative">
                <!-- Decorative Glow -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500/5 rounded-full blur-[80px]"></div>

                <div class="p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Subscription Management</h2>
                            <p class="text-gray-500 mt-1">Manage your billing and plan details.</p>
                        </div>
                        <div class="px-4 py-2 bg-brand-500/10 border border-brand-500/50 rounded-lg text-brand-400 font-bold uppercase tracking-wider text-sm">
                            Active
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="text-gray-500 text-sm uppercase font-bold tracking-wider mb-2">Current Plan</p>
                            <p class="text-3xl font-bold text-white capitalize">{{ str_replace('_', ' ', Auth::user()->subscription_plan) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm uppercase font-bold tracking-wider mb-2">Next Billing Date</p>
                            <p class="text-3xl font-bold text-white">{{ now()->addMonth()->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <div class="border-t border-white/10 pt-8">
                        <h3 class="text-lg font-bold text-white mb-4">Payment Method</h3>
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            <div>
                                <p class="text-white font-bold">Visa ending in 4242</p>
                                <p class="text-gray-500 text-xs">Expires 12/28</p>
                            </div>
                            <button class="ml-auto text-brand-500 text-sm font-bold hover:underline">Update</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 p-6 flex justify-between items-center">
                    <p class="text-sm text-gray-500">Need to take a break?</p>
                    <form action="{{ route('subscription.cancel') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 font-bold text-sm transition-colors">Cancel Subscription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
