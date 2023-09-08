/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'

module.exports = {
    presets: [preset],
    content: [
        "./resources/**/*.js",
        './app/Filament/**/*.php',
        "./resources/**/*.blade.php",
        './vendor/filament/**/*.blade.php',
        './resources/views/filament/**/*.blade.php',

    ],
    theme: {
        extend: {
            colors: {
                'jusan': '#fe5000',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ]
}
