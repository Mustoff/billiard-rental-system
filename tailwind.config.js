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

            colors: {
                dark: '#0f172a',
                primary: '#0ea5e9',
                secondary: '#f59e0b',

                navy: {
                    900: '#0f172a',
                    800: '#1e293b',
                    700: '#334155',
                },

                cyan: {
                    500: '#0ea5e9',
                    600: '#0284c7',
                },

                amber: {
                    500: '#f59e0b',
                    600: '#d97706',
                },
            },

            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },

            borderRadius: {
                xl: '0.75rem',
                '2xl': '1rem',
                '3xl': '1.5rem',
            },

            boxShadow: {
                sporty: '0 10px 30px rgba(14,165,233,0.15)',
                glow: '0 0 30px rgba(14,165,233,0.25)',
            },
        },
    },

    plugins: [forms],
};