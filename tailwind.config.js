import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                "fade-in-up": "fadeInUp 0.6s ease-out both",
                "fade-in-up-delay": "fadeInUp 0.6s ease-out 0.15s both",
                "fade-in-up-delay-2": "fadeInUp 0.6s ease-out 0.3s both",
                float: "float 6s ease-in-out infinite",
                "float-delay": "float 6s ease-in-out 2s infinite",
                "float-slow": "float 8s ease-in-out 1s infinite",
                shimmer: "shimmer 2s linear infinite",
                "pulse-glow": "pulseGlow 2s ease-in-out infinite",
            },
            keyframes: {
                fadeInUp: {
                    "0%": { opacity: "0", transform: "translateY(20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                float: {
                    "0%, 100%": { transform: "translateY(0px)" },
                    "50%": { transform: "translateY(-20px)" },
                },
                shimmer: {
                    "0%": { backgroundPosition: "-200% 0" },
                    "100%": { backgroundPosition: "200% 0" },
                },
                pulseGlow: {
                    "0%, 100%": {
                        boxShadow: "0 0 20px rgba(79, 70, 229, 0.3)",
                    },
                    "50%": { boxShadow: "0 0 40px rgba(79, 70, 229, 0.6)" },
                },
            },
        },
    },

    plugins: [forms],
};
