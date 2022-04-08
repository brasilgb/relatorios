module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      // colors: {},
    },
    fontFamily: {
      roboto: ["Roboto, sans-serif"]
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
