<div x-data 
     x-show="$store.loader.show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-md"
     style="display: none;">
    
    <div class="relative flex flex-col items-center">
        <!-- Quantum Spinner -->
        <div class="relative w-24 h-24">
            <!-- Outer Ring -->
            <div class="absolute inset-0 rounded-full border-2 border-brand-500/20 animate-[spin_3s_linear_infinite]"></div>
            <div class="absolute inset-0 rounded-full border-t-2 border-brand-500 animate-[spin_2s_linear_infinite]"></div>
            
            <!-- Inner Ring -->
            <div class="absolute inset-4 rounded-full border-2 border-brand-400/20 animate-[spin_3s_linear_infinite_reverse]"></div>
            <div class="absolute inset-4 rounded-full border-b-2 border-brand-400 animate-[spin_1.5s_linear_infinite_reverse]"></div>

            <!-- Core -->
            <div class="absolute inset-[38%] bg-brand-500 rounded-full animate-pulse shadow-[0_0_20px_rgba(245,158,11,0.5)]"></div>
        </div>
        
        <!-- Text -->
        <div class="mt-8 text-center">
            <p class="text-brand-500 font-display font-bold tracking-widest text-lg animate-pulse">PROCESSING</p>
            <p class="text-xs text-gray-500 mt-1">Calculating algorithms...</p>
        </div>
    </div>
</div>
