<x-app-layout>
    <div class="py-12 bg-black min-h-screen" x-data="{ annual: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Unlock Institutional Power
                </h2>
                <p class="mt-4 text-xl text-gray-400">
                    Choose the plan that fits your capital and ambition.
                </p>
                
                <!-- Toggle -->
                <div class="mt-8 flex justify-center">
                    <div class="relative bg-[#0a0a0a] border border-white/10 rounded-full p-1 flex">
                        <button @click="annual = false" :class="!annual ? 'bg-brand-500 text-black shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white'" class="relative w-32 py-2 rounded-full text-sm font-bold transition-all duration-300">
                            Monthly
                        </button>
                        <button @click="annual = true" :class="annual ? 'bg-brand-500 text-black shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white'" class="relative w-32 py-2 rounded-full text-sm font-bold transition-all duration-300">
                            Yearly <span class="text-[10px] ml-1 bg-green-500/20 text-green-400 px-1 py-0.5 rounded">-20%</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Starter -->
                <div class="relative bg-[#0a0a0a] border border-white/5 rounded-2xl p-8 flex flex-col items-center hover:border-white/20 transition-all duration-300">
                    <h3 class="text-xl font-bold text-gray-400 uppercase tracking-wide">Starter</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-5xl font-extrabold text-white">Free</span>
                    </div>
                    <ul class="mt-8 space-y-4 w-full">
                        <li class="flex items-center text-gray-400">
                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Basic AI Analysis</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Manual Trading</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">1 Connected Account</span>
                        </li>
                    </ul>
                    <button disabled class="mt-8 w-full py-3 px-6 rounded-xl border border-white/10 text-gray-500 font-bold cursor-not-allowed">Current Plan</button>
                </div>

                <!-- Pro -->
                <div class="relative bg-[#0a0a0a] border border-brand-500 rounded-2xl p-8 flex flex-col items-center shadow-[0_0_50px_rgba(234,179,8,0.1)] transform scale-105">
                    <div class="absolute top-0 transform -translate-y-1/2 bg-brand-500 text-black font-bold px-4 py-1 rounded-full text-sm shadow-lg shadow-brand-500/20">MOST POPULAR</div>
                    <h3 class="text-xl font-bold text-brand-400 uppercase tracking-wide">Pro</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-5xl font-extrabold text-white">$99</span>
                        <span class="ml-1 text-xl text-gray-500">/mo</span>
                    </div>
                     <p x-show="annual" class="text-sm text-green-400 mt-1 font-bold">Billed $950 yearly</p>
                    <ul class="mt-8 space-y-4 w-full">
                        <li class="flex items-center text-white">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Advanced AI Signals</span>
                        </li>
                        <li class="flex items-center text-white">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Auto-Trade Execution</span>
                        </li>
                        <li class="flex items-center text-white">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">5 Connected Accounts</span>
                        </li>
                         <li class="flex items-center text-white">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Risk Management Suite</span>
                        </li>
                    </ul>
                    <form action="{{ route('subscription.upgrade') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="plan" value="pro">
                        <button type="submit" class="mt-8 w-full py-3 px-6 rounded-xl bg-brand-500 hover:bg-brand-400 text-black font-bold shadow-lg shadow-brand-500/20 transition-all duration-300">Upgrade to Pro</button>
                    </form>
                </div>

                <!-- Hedge Fund -->
                <div class="relative bg-[#0a0a0a] border border-white/5 rounded-2xl p-8 flex flex-col items-center hover:border-brand-500/30 transition-all duration-300">
                    <h3 class="text-xl font-bold text-white uppercase tracking-wide">Hedge Fund</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-5xl font-extrabold text-white">$299</span>
                        <span class="ml-1 text-xl text-gray-500">/mo</span>
                    </div>
                    <ul class="mt-8 space-y-4 w-full">
                        <li class="flex items-center text-gray-300">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Institutional Latency</span>
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Unlimited Accounts</span>
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">Dedicated Server</span>
                        </li>
                         <li class="flex items-center text-gray-300">
                            <svg class="flex-shrink-0 h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="ml-3">24/7 Priority Support</span>
                        </li>
                    </ul>
                    <form action="{{ route('subscription.upgrade') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="plan" value="hedge_fund">
                        <button type="submit" class="mt-8 w-full py-3 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold transition-all duration-300">Contact Sales</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
