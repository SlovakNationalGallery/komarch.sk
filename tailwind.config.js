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
            white: '#FFFFFF',
            black: '#000000',
            blue: '#001DFF',
            gray: {
                100: '#F5F5F5',
                300: '#969696',
                500: '#707070',
                900: '#040405',
            }
        }
    },
    variants: {},
    plugins: [],
}
