import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#c3110c',
                    950: '#280905',
                    900: '#740a03',
                    700: '#9a0b08',
                    600: '#c3110c',
                    500: '#d9391b',
                    400: '#e6501b',
                    300: '#f07a4a',
                    200: '#f8b89a',
                    100: '#fde8de',
                    50: '#fef5f0',
                },
                neutral: {
                    950: '#0a0a0a',
                    900: '#171717',
                    800: '#262626',
                    700: '#404040',
                    600: '#525252',
                    500: '#737373',
                    400: '#a3a3a3',
                    300: '#d4d4d4',
                    200: '#e5e5e5',
                    100: '#f5f5f5',
                    50: '#fafafa',
                },
                secondary: {
                    DEFAULT: '#2e7d52',
                    light: '#e8f5ee',
                },
                accent: '#f5a623',
                dark: '#1c2b39',
            },
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                body: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
            },
        },
    },

    plugins: [forms, typography],
};
