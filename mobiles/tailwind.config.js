/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./App.{js,jsx,ts,tsx}", "./screens/**/*.{js,jsx,ts,tsx}", "./components/**/*.{js,jsx,ts,tsx}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito_400Regular'], // NativeWind maps this to font-family style
        bold: ['Nunito_700Bold'],
        // We can map other weights if needed
      },
      colors: {
        brand: {
          50: '#fffbf0',
          100: '#fff4c6',
          200: '#ffe688',
          300: '#ffd24a',
          400: '#ffb918',
          500: '#f59e0b', // Amber
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
          950: '#451a03',
        },
        accent: {
          DEFAULT: '#1e1b4b',
          500: '#1e1b4b', // Deep Indigo
          600: '#312e81',
        },
        'rich-black': {
          50: '#f6f6f6',
          100: '#e7e7e7',
          200: '#d1d1d1',
          300: '#b0b0b0',
          400: '#888888',
          500: '#6d6d6d',
          600: '#5d5d5d',
          700: '#4f4f4f',
          800: '#454545',
          900: '#0a0a0a', // Main background
          950: '#000000',
        },
        // Mapping 'dark' to match our previous usage but with new palette
        dark: {
          bg: '#050505', // Matching body bg in app.blade.php
          card: '#0a0a0a', // Matching rich-black-900
          border: 'rgba(255,255,255,0.1)',
        }
      }
    },
  },
  plugins: [],
}
