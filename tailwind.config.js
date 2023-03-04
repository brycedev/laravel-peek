/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./resources/views/**/*.blade.php', './resources/js/**/*.vue'],
  darkMode: 'class',
  theme: {
    extend: {
      fontSize: {
        '2xs': '.625rem',
      },
      opacity: {
        '2.5': '.025',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
