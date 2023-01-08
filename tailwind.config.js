/** @type {import('tailwindcss').Config} */

/** la commande pour compiler : npx tailwindcss -i ./assets/tailwind.css -o ./assets/main.css --watch */

module.exports = {
  content: [
      "./**/*.php",
      "./page/**/*.php",
      "./assets/js/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
