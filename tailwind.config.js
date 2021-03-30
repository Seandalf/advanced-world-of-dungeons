const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/components/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
                fantasy: ['Lobster Two'],
                handwriting: ['Indie Flower']
            },
            colors: {
                'taupe': '#cc2b5e',
                'violet': '#753a88'
            },
            screens: {
                'xs': '500px',
                'mdl': '896px'
            },
            fontSize: {
                'ds': '.8175rem'
            }
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            pointerEvents: ['disabled'],
            transitionProperty: ['hover', 'focus']
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
