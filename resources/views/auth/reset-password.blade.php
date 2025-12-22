<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white tracking-tight">Set New Password</h2>
        <p class="text-gray-400 text-sm mt-1">Secure your trading account</p>
    </div>

    <div x-data="{ submitting: false }">
        <form method="POST" action="{{ route('password.store') }}" class="space-y-5" @submit.prevent="submitting = true; $store.loader.start(); setTimeout(() => $el.submit(), 1000)">
            @csrf
    
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <div class="pt-2">
                <x-primary-button class="transition-opacity duration-300" ::class="{ 'opacity-75 cursor-wait': submitting }">
                    <span x-show="!submitting">{{ __('Reset Password') }}</span>
                    <span x-show="submitting" style="display: none;">Resetting...</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
