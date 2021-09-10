module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      fontFamily: { sans: ['Inter var'] },
    }
  },
  variants: {
    extend: {
        borderWidth: ['hover'],
    }
  },
  plugins: [
    require('@tailwindcss/ui'),
    require('@tailwindcss/custom-forms'),
  ]
}
