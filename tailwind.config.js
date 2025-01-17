const flowbite = require('flowbite/plugin');
const forms = require('@tailwindcss/forms');
const aspectRatio = require('@tailwindcss/aspect-ratio');
const typography = require('@tailwindcss/typography');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/modus-digital/modus-ui/src/View/Components/**/**/*.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/**/*.ts",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [ flowbite, forms, aspectRatio, typography ],
} 