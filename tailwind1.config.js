/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            header_2: ['Fjalla One', 'sans-serif'],
            headeer_1: ['Roboto', 'sans-serif'],

        },

    },
    textColor: {
        skin: {
            base: 'var(--color-text-base)',
            muted: 'var( --color-text-muted)',
        }
    },

    fontSize: {
        h1: '2.5rem',
        h2: '2rem',
        letter_k: '4.5rem',
    },
},
  plugins: [],
}
