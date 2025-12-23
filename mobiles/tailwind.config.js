/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./App.{js,jsx,ts,tsx}", "./screens/**/*.{js,jsx,ts,tsx}", "./components/**/*.{js,jsx,ts,tsx}"],
  theme: {
    extend: {
      colors: {
        brand: {
          DEFAULT: '#8b5cf6', // Violet-500
          500: '#8b5cf6',
          400: '#a78bfa',
          600: '#7c3aed',
        },
        accent: {
          DEFAULT: '#06b6d4', // Cyan-500
          500: '#06b6d4',
        },
        dark: {
          bg: '#050505',
          card: '#0a0a0a',
          border: 'rgba(255,255,255,0.1)',
        }
      }
    },
  },
  plugins: [],
}
