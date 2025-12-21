<x-guest-layout>
    <div x-data="registerWizard()" x-cloak>
        
        <!-- Header Dynamic -->
        <div class="mb-10 text-center" x-show="step < 4">
            <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-200 via-brand-400 to-brand-200 tracking-tight drop-shadow-sm" 
                x-text="stepTitle"></h2>
            <p class="text-gray-400 text-sm mt-2" x-text="stepDesc"></p>
            
            <!-- Step Indicators -->
            <div class="flex justify-center gap-2 mt-6">
                <template x-for="i in 3">
                    <div class="h-1.5 rounded-full transition-all duration-500"
                        :class="i <= step ? 'w-8 bg-brand-500 shadow-[0_0_10px_rgba(245,158,11,0.5)]' : 'w-2 bg-gray-700'"></div>
                </template>
            </div>
        </div>

        <!-- Success Screen (Step 4) -->
        <div x-show="step === 4" class="text-center py-10" 
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            
            <div class="w-24 h-24 bg-brand-500/20 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                <div class="absolute inset-0 bg-brand-500/20 rounded-full animate-ping"></div>
                <svg class="w-12 h-12 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-white mb-2">Welcome Aboard!</h2>
            <p class="text-gray-400 mb-8 max-w-xs mx-auto">Your account has been successfully created. You are now ready to start your trading journey.</p>
            
            <a href="{{ route('dashboard') }}" 
               class="inline-block w-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-400 hover:to-brand-600 text-black font-bold py-4 px-6 rounded-xl shadow-lg shadow-brand-500/20 transform transition hover:-translate-y-1 hover:shadow-brand-500/40 tracking-wide text-lg">
                Go to Dashboard
            </a>
        </div>

        <!-- Wizard Forms -->
        <div x-show="step < 4" class="relative min-h-[300px]">
            
            <!-- Error Message -->
            <div x-show="error" x-transition 
                 class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span x-text="error"></span>
            </div>

            <!-- STEP 1: Email -->
            <div x-show="step === 1" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300 transform absolute top-0 w-full"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-10">
                 
                <form @submit.prevent="sendOtp">
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <div class="relative">
                            <x-text-input x-model="form.email" type="email" class="pl-11" placeholder="trader@example.com" required autofocus />
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" :disabled="loading"
                        class="w-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-400 hover:to-brand-600 text-black font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-brand-500/20 transform transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 group">
                        <span x-text="loading ? 'Sending Code...' : 'Continue'"></span>
                        <svg x-show="!loading" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                    
                    <div class="mt-6 text-center text-sm text-gray-500">
                        Already verified? <a href="{{ route('login') }}" class="text-brand-400 hover:text-brand-300">Sign In</a>
                    </div>
                </form>
            </div>

            <!-- STEP 2: OTP Verification -->
            <div x-show="step === 2" style="display: none;"
                 x-transition:enter="transition ease-out duration-300 transform delay-300"
                 x-transition:enter-start="opacity-0 translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300 transform absolute top-0 w-full"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-10">
                
                <div class="text-center mb-6">
                    <p class="text-gray-400 text-sm">We sent a 6-digit code to <br><span class="text-white font-medium" x-text="form.email"></span></p>
                    <button @click="step = 1" class="text-brand-500 text-xs mt-2 hover:underline">Change Email</button>
                </div>

                <form @submit.prevent="verifyOtp">
                    <div class="mb-8 flex justify-center gap-3">
                        <template x-for="(digit, index) in 6" :key="index">
                            <input type="text" maxlength="1" 
                                x-model="otpDigits[index]"
                                @input="handleOtpInput($event, index)"
                                @keydown.backspace="handleBackspace($event, index)"
                                :id="'otp-' + index"
                                class="w-12 h-14 text-center text-2xl font-bold bg-white/5 border border-white/10 rounded-xl focus:border-brand-500 focus:ring-2 focus:ring-brand-500/50 text-white transition-all caret-brand-500"
                                required />
                        </template>
                    </div>

                    <button type="submit" :disabled="loading || otpDigits.join('').length !== 6"
                        class="w-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-400 hover:to-brand-600 text-black font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-brand-500/20 transform transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-text="loading ? 'Verifying...' : 'Verify Email'"></span>
                    </button>
                    
                    <div class="mt-6 text-center text-sm">
                        <button type="button" @click="sendOtp" class="text-gray-500 hover:text-brand-400 transition-colors">Resend Code</button>
                    </div>
                </form>
            </div>

            <!-- STEP 3: Details -->
            <div x-show="step === 3" style="display: none;"
                 x-transition:enter="transition ease-out duration-300 transform delay-300"
                 x-transition:enter-start="opacity-0 translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0">
                
                <form @submit.prevent="submitRegistration">
                    
                    <!-- Username with Real-time Validation -->
                    <div class="mb-5">
                        <x-input-label for="name" :value="__('Choose Username')" />
                        <div class="relative group">
                            <input type="text" x-model="form.name" @input.debounce.500ms="checkUsername"
                                class="w-full bg-white/5 border rounded-xl px-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-2 transition-all duration-300"
                                :class="usernameStatusClasses"
                                placeholder="CryptoKing99" required />
                            
                            <!-- Validation Icon -->
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <template x-if="usernameAvailable === true">
                                    <svg class="h-6 w-6 text-green-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </template>
                                <template x-if="usernameAvailable === false">
                                    <svg class="h-6 w-6 text-red-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </template>
                                <template x-if="checkingUsername">
                                    <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </template>
                            </div>
                        </div>
                        <!-- Validation Message -->
                        <p class="text-xs mt-2" :class="usernameAvailable === false ? 'text-red-400' : 'text-green-400'" 
                           x-text="usernameMessage"></p>
                    </div>

                    <!-- Password Section (Revealed only if username is valid) -->
                    <div x-show="usernameAvailable === true" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 max-h-0"
                         x-transition:enter-end="opacity-100 max-h-[300px]">
                        
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input x-model="form.password" type="password" class="w-full" placeholder="Create a strong password" required />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input x-model="form.passwordConfirmation" type="password" class="w-full" placeholder="Repeat password" required />
                        </div>

                        <button type="submit" :disabled="loading || form.password.length < 8 || form.password !== form.passwordConfirmation"
                            class="w-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-400 hover:to-brand-600 text-black font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-brand-500/20 transform transition disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-text="loading ? 'Creating Account...' : 'Complete Registration'"></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="text-center mt-6 mb-8 text-sm text-gray-500">
        Already have an account? 
        <a href="{{ route('login') }}" class="font-medium text-brand-400 hover:text-brand-300 transition-colors duration-200">
            Sign In
        </a>
    </div>

    <!-- Social Login (Only show on step 1) -->
    <div x-show="step === 1">
        <x-social-login />
    </div>

    <script>
        function registerWizard() {
            return {
                step: 1,
                loading: false,
                checkingUsername: false,
                usernameAvailable: null, // null = unchecked, true = valid, false = taken
                error: null,
                form: {
                    email: '',
                    name: '',
                    password: '',
                    passwordConfirmation: ''
                },
                otpDigits: ['', '', '', '', '', ''],

                get stepTitle() {
                    if(this.step === 1) return 'Get Started';
                    if(this.step === 2) return 'Verify Email';
                    if(this.step === 3) return 'Account Details';
                    return 'Success';
                },

                get stepDesc() {
                    if(this.step === 1) return 'Enter your email to verify your identity';
                    if(this.step === 2) return 'Enter the 6-digit code sent to your inbox';
                    if(this.step === 3) return 'Choose your trading handle';
                    return '';
                },
                
                get usernameStatusClasses() {
                    if(this.usernameAvailable === true) return 'border-green-500/50 focus:border-green-500 focus:ring-green-500/20';
                    if(this.usernameAvailable === false) return 'border-red-500/50 focus:border-red-500 focus:ring-red-500/20';
                    return 'border-white/10 focus:border-brand-500 focus:ring-brand-500/50';
                },

                get usernameMessage() {
                    if(this.usernameAvailable === true) return 'Username is available!';
                    if(this.usernameAvailable === false) return 'Username is already taken.';
                    return '';
                },

                async sendOtp() {
                    this.loading = true;
                    this.error = null;
                    try {
                        const res = await axios.post("{{ route('register.send-otp') }}", { email: this.form.email });
                        console.log(res.data); // For dev seeing OTP
                        this.step = 2;
                        this.$nextTick(() => document.getElementById('otp-0').focus());
                    } catch (e) {
                        this.error = e.response?.data?.errors?.email?.[0] || 'Failed to send OTP. Please try again.';
                    } finally {
                        this.loading = false;
                    }
                },

                handleOtpInput(e, index) {
                    const input = e.target;
                    const val = input.value;
                    
                    // Allow only numbers
                    if (!/^\d*$/.test(val)) {
                        input.value = '';
                        this.otpDigits[index] = '';
                        return;
                    }

                    if (val.length === 1 && index < 5) {
                        document.getElementById('otp-' + (index + 1)).focus();
                    }
                },

                handleBackspace(e, index) {
                    if (e.target.value === '' && index > 0) {
                        document.getElementById('otp-' + (index - 1)).focus();
                    }
                },

                async verifyOtp() {
                    this.loading = true;
                    this.error = null;
                    const otp = this.otpDigits.join('');
                    try {
                        await axios.post("{{ route('register.verify-otp') }}", { 
                            email: this.form.email, 
                            otp: otp 
                        });
                        this.step = 3;
                    } catch (e) {
                        this.error = 'Invalid code. Please check and try again.';
                    } finally {
                        this.loading = false;
                    }
                },

                async checkUsername() {
                    if (this.form.name.length < 3) {
                        this.usernameAvailable = null;
                        return;
                    }
                    this.checkingUsername = true;
                    this.usernameAvailable = null;
                    try {
                        const res = await axios.post("{{ route('register.check-username') }}", { username: this.form.name });
                        this.usernameAvailable = res.data.available;
                    } catch (e) {
                        this.usernameAvailable = false;
                    } finally {
                        this.checkingUsername = false;
                    }
                },

                async submitRegistration() {
                    this.loading = true;
                    Alpine.store('loader').start();
                    this.error = null;
                    try {
                        const res = await axios.post("{{ route('register') }}", {
                            name: this.form.name,
                            email: this.form.email,
                            password: this.form.password,
                            password_confirmation: this.form.passwordConfirmation
                        });
                        this.step = 4; // Show success
                    } catch (e) {
                        this.error = e.response?.data?.message || 'Registration failed.';
                    } finally {
                        this.loading = false;
                        Alpine.store('loader').stop();
                    }
                }
            }
        }
    </script>
</x-guest-layout>
