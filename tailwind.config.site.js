//--------------------------------------------------------------------------
// Tailwind site configuration
//--------------------------------------------------------------------------
//
// Use this file to completely define the current sites design system by
// adding and extending to Tailwinds default utility classes.
//

const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')
const colors = require('tailwindcss/colors')

module.exports = {
    presets: [],
    theme: {
        // Here we define the default colors available. If you want to include
        // all default Tailwind colors you should extend the colors instead.

        extend: {
            // Set default transition durations and easing when using the transition utilities.
            transitionDuration: {
                DEFAULT: "300ms",
            },
            transitionTimingFunction: {
                DEFAULT: "cubic-bezier(0.4, 0, 0.2, 1)",
            },
            colors: {
                black: "#000",
                white: "#fff",
                gray: {
                    800: "#4b4b4b",
                    900: "#333333",
                },
                teal: {
                    100: "#98D6CE",
                    200: "#3AB18E",
                },
            },
        },
        // Remove the font families you don't want to use.
        fontFamily: {
            display: ["Raleway"],
        },
        fontFamily: {
            sans: ["Fibra", ...defaultTheme.fontFamily.sans],
        },
        // The font weights available for this site.
        fontWeight: {
            hairline: 100,
            thin: 200,
            light: 300,
            normal: 400,
            medium: 500,
            semibold: 600,
            bold: 700,
            extrabold: 800,
            black: 900,
        },
    },
    plugins: [
        plugin(function ({ addBase, theme }) {
            addBase({
                // Default color transition on links unless user prefers reduced motion.
                "@media (prefers-reduced-motion: no-preference)": {
                    a: {
                        transition: "color .3s ease-in-out",
                    },
                },
                html: {
                    color: theme("colors.neutral.DEFAULT"),
                    //--------------------------------------------------------------------------
                    // Set sans, serif or mono stack with optional custom font as default.
                    //--------------------------------------------------------------------------
                    // fontFamily: theme('fontFamily.mono'),
                    fontFamily: theme("fontFamily.sans"),
                    // fontFamily: theme('fontFamily.serif'),
                },
                mark: {
                    backgroundColor: theme("colors.primary.DEFAULT"),
                    color: theme("colors.white"),
                },
            });
        }),

        // Custom components for this particular site.
        plugin(function ({ addComponents, theme }) {
            const components = {};
            addComponents(components);
        }),

        // Custom utilities for this particular site.
        plugin(function ({ addUtilities, theme, variants }) {
            const newUtilities = {};
            addUtilities(newUtilities);
        }),
    ],
};
