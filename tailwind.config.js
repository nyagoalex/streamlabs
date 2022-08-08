const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  media: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            primary: '#401D98',
            secondary: '#D60385',
            gray: colors.slate,
            purple: colors.violet
        },
        fontFamily: {
            display: ['Barlow', ...defaultTheme.fontFamily.sans]
        }
    },
    container: {
      center: true,
      padding: '2em',
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/typography'),
  ],
}
