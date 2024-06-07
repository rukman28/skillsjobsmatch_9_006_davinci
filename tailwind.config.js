/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    textColor: {
        skin: {
            base: 'var(--color-text-base)',
        }
    },
    backgroundColor: {
        fill: {
            primary: 'var(--primary-color)',
            secondary: 'var(--secondary-color)'
        }
    },
    fontSize: {
        h1: '2.5rem',
        h2: '2rem',
    },
    fontWeight: {
        h1: '650',
    }
  },
  plugins: [],
}
