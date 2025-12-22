<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white tracking-tight">Recover Password</h2>
        <p class="text-gray-400 text-sm mt-1">Enter your email to receive a reset link</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div x-data="{ submitting: false }">
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5" @submit.prevent="submitting = true; $store.loader.start(); setTimeout(() => $el.submit(), 1000)">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="pt-2">
                <x-primary-button class="transition-opacity duration-300" ::class="{ 'opacity-75 cursor-wait': submitting }">
                    <span x-show="!submitting">{{ __('Send Reset Link') }}</span>
                    <span x-show="submitting" style="display: none;">Sending...</span>
                </x-primary-button>
            </div>
    
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm font-medium text-brand-400 hover:text-brand-300 transition-colors duration-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
