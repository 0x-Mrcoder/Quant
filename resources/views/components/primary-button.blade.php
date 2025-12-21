<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-400 hover:to-brand-600 text-black font-bold py-3 px-4 rounded-xl shadow-lg shadow-brand-500/20 transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 focus:ring-offset-[#0B0F19] tracking-wide']) }}>
    {{ $slot }}
</button>
