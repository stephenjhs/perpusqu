/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme")
module.exports = {
  content: ["./app/views/home/*.php"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Source Sans Pro", ...defaultTheme.fontFamily.sans]
      },
      "colors": {
    "orange": {
      "50": "#cb3232",
      "100": "#c12828",
      "200": "#b71e1e",
      "300": "#ad1414",
      "400": "#a30a0a",
      "500": "#990000",
      "600": "#8f0000",
      "700": "#850000",
      "800": "#7b0000",
      "900": "#710000"
    }
  }
    },
  },
  plugins: [],
}
