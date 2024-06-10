/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
        roboto: ['Roboto', 'sans-serif'],
        Fjualla: ['Fjalla One', 'sans-serif'],
        notoserif: ['Noto Serif', 'serif'],
    },
    screens: {
        tablet: '790px',
        screen_height: '997px'

    },
    extend: {},
  },
  plugins: [],
}
