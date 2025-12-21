<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto space-y-8">
        
        <!-- Headers -->
        <div>
            <h2 class="text-3xl font-bold text-white">User Profile</h2>
            <p class="text-gray-500 mt-2">Manage your personal information and security settings.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Update Profile Info -->
            <div class="p-8 rounded-2xl bg-[#0a0a0a] border border-white/5 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-5">
                    <svg class="w-32 h-32 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-brand-500 rounded-full"></span>
                    Profile Information
                </h3>
                
                <div class="relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-8 rounded-2xl bg-[#0a0a0a] border border-white/5 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-5">
                    <svg class="w-32 h-32 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>

                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-brand-500 rounded-full"></span>
                    Security
                </h3>

                <div class="relative z-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete Account (Full Width) -->
        <div class="p-8 rounded-2xl bg-red-500/5 border border-red-500/20 relative overflow-hidden">
             <div class="absolute top-0 right-0 p-6 opacity-5">
                <svg class="w-32 h-32 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            </div>

            <h3 class="text-xl font-bold text-red-500 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                Danger Zone
            </h3>

            <div class="relative z-10 max-w-xl">
                 @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
