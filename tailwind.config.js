/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./lang/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                brand: "#194B7E",
                "brand-light": "#8ebae8",
            },
            screens: {
                xsm: "640px",
            },
        },
    },
    plugins: [],
};
