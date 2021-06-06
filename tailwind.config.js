const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        fontFamily: {
            sans: ['Ubuntu', ...defaultTheme.fontFamily.sans],
        },
        backgroundImage: {
            'phone': "url('/img/phone.png')",
        },
        width: {
            '443': '443px',
        },
        width: {
            '750': '750px',
            '800': '800px',
            '144': '144rem',
        },
    },
  },
  variants: {
    extend: {},
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
}
