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
    },
    variants: {},
    plugins: [],
}
