/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: "#a036e2",
        },
        light: {
          DEFAULT: "#faf1ff",
        },
        dark: {
          DEFAULT: "#261c2d",
        }
      }
    },
  },
  plugins: [],
}
