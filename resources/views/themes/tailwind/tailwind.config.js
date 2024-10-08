/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./**/*.php",
        "./*.php",
        "./assets/**/*.scss",
        "./assets/**/*.js",
        "./assets/**/*.{ts,tsx}",
        "./assets/js/components/**/*.{ts,tsx}",
    ],
    theme: {
        container: {
            center: true,
            padding: "2rem",
            screens: {
                "2xl": "1400px",
            },
        },
        extend: {
            rotate: {
                "-1": "-1deg",
                "-2": "-2deg",
                "-3": "-3deg",
                1: "1",
                2: "2deg",
                3: "3deg",
            },

            keyframes: {
                "accordion-down": {
                    from: { height: "0" },
                    to: { height: "var(--radix-accordion-content-height)" },
                },
                "accordion-up": {
                    from: { height: "var(--radix-accordion-content-height)" },
                    to: { height: "0" },
                },
            },
            animation: {
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
            },
            borderRadius: {
                lg: `var(--radius)`,
                md: `calc(var(--radius) - 2px)`,
                sm: "calc(var(--radius) - 4px)",
                xl: "0.8rem",
                xxl: "1rem",
            },
            height: {
                "1/2": "0.125rem",
                "2/3": "0.1875rem",
            },
            maxHeight: {
                16: "16rem",
                20: "20rem",
                24: "24rem",
                32: "32rem",
            },
            inset: {
                "1/2": "50%",
            },
            width: {
                96: "24rem",
                104: "26rem",
                128: "32rem",
            },
            transitionDelay: {
                450: "450ms",
            },
            colors: {
                border: "hsl(var(--border))",
                input: "hsl(var(--input))",
                ring: "hsl(var(--ring))",
                background: "hsl(var(--background))",
                foreground: "hsl(var(--foreground))",
                primary: {
                    DEFAULT: "hsl(var(--primary))",
                    foreground: "hsl(var(--primary-foreground))",
                },
                secondary: {
                    DEFAULT: "hsl(var(--secondary))",
                    foreground: "hsl(var(--secondary-foreground))",
                },
                destructive: {
                    DEFAULT: "hsl(var(--destructive))",
                    foreground: "hsl(var(--destructive-foreground))",
                },
                muted: {
                    DEFAULT: "hsl(var(--muted))",
                    foreground: "hsl(var(--muted-foreground))",
                },
                accent: {
                    DEFAULT: "hsl(var(--accent))",
                    foreground: "hsl(var(--accent-foreground))",
                },
                popover: {
                    DEFAULT: "hsl(var(--popover))",
                    foreground: "hsl(var(--popover-foreground))",
                },
                card: {
                    DEFAULT: "hsl(var(--card))",
                    foreground: "hsl(var(--card-foreground))",
                },
                wave: {
                    50: "#F2F8FF",
                    100: "#E6F0FF",
                    200: "#BFDAFF",
                    300: "#99C3FF",
                    400: "#4D96FF",
                    500: "#0069FF",
                    600: "#005FE6",
                    700: "#003F99",
                    800: "#002F73",
                    900: "#00204D",
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("tailwindcss-animate"),
    ],
};
