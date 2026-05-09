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
                    950: '#280905',
                    900: '#740A03',
                    700: '#9A0B08',
                    600: '#C3110C',
                    500: '#D9391B',
                    400: '#E6501B',
                    300: '#F07A4A',
                    200: '#F8B89A',
                    100: '#FDE8DE',
                    50: '#FEF5F0',
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
                    DEFAULT: '#2E7D52',
                    light: '#E8F5EE',
                },
                accent: '#F5A623',
                dark: '#1C2B39',
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
