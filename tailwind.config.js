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
            xl: '1280px',
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
        fontSize: {},  // add
        fontWeight: {},  // add
        letterSpacing: {},  // add
        lineHeight: {},  // add
        // spacing - default
        // borderRadius - default
        // borderWidth - default
        // opacity - default
        // height - default
        // width - default
        // transitions - default
        // z-index - default
        // everything rest default
        animation: {},
        keyframes: {},
        backgroundImage: {},
        backgroundPosition: {},
        backgroundSize: {},
        boxShadow: {},
        objectPosition: {},
    },
    variants: {},
    plugins: [],
}
