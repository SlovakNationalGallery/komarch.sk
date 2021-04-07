/*
    Default configuration:
    https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/defaultConfig.stub.js
 */
module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1200px',
        },
        colors: {
            transparent: 'transparent',
            white: '#FFFFFF',
            black: '#000000',
            blue: '#001DFF',
            gray: {
                100: '#F5F5F5',
                300: '#969696',
                500: '#707070',
                900: '#040405',
            }
        },
        fontFamily: {
            komarch: [
                'Komarch',
                'ui-sans-serif',
                'system-ui',
                '-apple-system',
                'BlinkMacSystemFont',
                '"Segoe UI"',
                'Roboto',
                '"Helvetica Neue"',
                'Arial',
                '"Noto Sans"',
                'sans-serif',
                '"Apple Color Emoji"',
                '"Segoe UI Emoji"',
                '"Segoe UI Symbol"',
                '"Noto Color Emoji"',
            ],
        },
        fontSize: {
            xs: ['10px'],
            sm: ['13px'],
            base: ['16px'],
            lg: ['18px'],
            xl: ['28px'],
            '2xl': ['40px'],
        },
        fontWeight: {
            normal: '400'
        },
        lineHeight: {
            none: '1',
            tight: '1.25',
            snug: '1.375',
            normal: '1.5',
            relaxed: '1.625',
            loose: '2',
        },
        transitionProperty: {
            none: 'none',
            all: 'all',
            DEFAULT: 'background-color, border-color, color, fill, stroke, opacity, box-shadow, transform',
            colors: 'background-color, border-color, color, fill, stroke',
            opacity: 'opacity',
            shadow: 'box-shadow',
            transform: 'transform',
            'max-h': 'max-height'
        }
    },
    variants: {
        extend: {
            translate: ['group-hover'],
            backgroundColor: ['checked'],
        }
    },
    plugins: [],
}
