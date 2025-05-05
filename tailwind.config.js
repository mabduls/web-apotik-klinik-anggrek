import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#4F9CFA',
                secondary: '#84CEE8',
                accent: '#FFB6C1',
                lilac: '#F0E6FF',
                grey: '#6B7280',
                'light-grey': '#F5F5F7',
            },
            screens: {
                'xs': '475px',
            }
        },
    },

    plugins: [forms],
    darkMode: 'class',
};
