const colors = require("tailwindcss/colors");
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
                accent: {
                    DEFAULT: colors.slate["800"],
                },
                light: {
                    DEFAULT: "#EBEDFF",
                },
                dark: {
                    DEFAULT: "#261c2d",
                },
            },
        },
    },
    plugins: [require("@tailwindcss/container-queries")],
};
