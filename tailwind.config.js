import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/src/*.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/WireUi/**/*.php',
        './vendor/wireui/wireui/src/Components/**/*.php',
    ],

    theme: {
        extend: {
            "colors": {
                "brand-secondary": "#006b54",
                "secondary": {
                    "DEFAULT": "#006b54", // Set DEFAULT to Stitch secondary
                    "50": "#f8fafc",
                    "100": "#f1f5f9",
                    "200": "#e2e8f0",
                    "300": "#cbd5e1",
                    "400": "#94a3b8",
                    "500": "#64748b",
                    "600": "#475569",
                    "700": "#334155",
                    "800": "#1e293b",
                    "900": "#0f172a",
                    "950": "#020617"
                },
                "tertiary-fixed-dim": "#e5b9dc",
                "on-tertiary-container": "#492a45",
                "on-surface-variant": "#574235",
                "on-primary": "#ffffff",
                "primary-container": "#f57c00",
                "on-background": "#1c1c19",
                "surface-dim": "#ddd9d5",
                "surface-container-low": "#f7f3ee",
                "tertiary-fixed": "#ffd7f6",
                "on-error": "#ffffff",
                "surface-container": "#f1ede8",
                "on-secondary-container": "#007259",
                "surface-container-highest": "#e6e2dd",
                "surface": "#fdf9f4",
                "on-primary-container": "#572800",
                "secondary-container": "#81f8d1",
                "outline-variant": "#dec1af",
                "surface-container-high": "#ebe8e3",
                "primary-fixed-dim": "#ffb786",
                "on-surface": "#1c1c19",
                "on-tertiary": "#ffffff",
                "on-primary-fixed-variant": "#723600",
                "surface-tint": "#964900",
                "on-tertiary-fixed": "#2d112b",
                "on-primary-fixed": "#311300",
                "primary-fixed": "#ffdcc6",
                "on-error-container": "#93000a",
                "secondary-fixed": "#81f8d1",
                "primary": {
                    "DEFAULT": "#964900",
                    "50": "#fff7ed",
                    "100": "#ffedd5",
                    "200": "#fed7aa",
                    "300": "#fdba74",
                    "400": "#fb923c",
                    "500": "#f97316",
                    "600": "#ea580c",
                    "700": "#c2410c",
                    "800": "#9a3412",
                    "900": "#7c2d12",
                    "950": "#431407"
                },
                "surface-container-lowest": "#ffffff",
                "on-tertiary-fixed-variant": "#5d3c58",
                "error-container": "#ffdad6",
                "on-secondary-fixed": "#002117",
                "secondary-fixed-dim": "#63dbb6",
                "inverse-surface": "#31302d",
                "inverse-on-surface": "#f4f0eb",
                "outline": "#8b7263",
                "surface-bright": "#fdf9f4",
                "on-secondary-fixed-variant": "#00513e",
                "on-secondary": "#ffffff",
                "tertiary-container": "#b991b2",
                "background": "#fdf9f4",
                "tertiary": "#765371",
                "surface-variant": "#e6e2dd",
                "error": "#ba1a1a",
                "inverse-primary": "#ffb786",
                "brand-secondary": "#006b54" // Keep for backward compatibility
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "margin-desktop": "80px",
                "gutter": "24px",
                "base": "4px",
                "margin-mobile": "16px",
                "container-max": "1280px"
            },
            "fontFamily": {
                "label-sm": ["Plus Jakarta Sans"],
                "label-md": ["Plus Jakarta Sans"],
                "headline-md": ["Plus Jakarta Sans"],
                "body-lg": ["Plus Jakarta Sans"],
                "headline-lg-mobile": ["Plus Jakarta Sans"],
                "headline-lg": ["Plus Jakarta Sans"],
                "body-md": ["Plus Jakarta Sans"],
                "headline-xl": ["Plus Jakarta Sans"],
                "sans": ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            "fontSize": {
                "label-sm": ["11px", {"lineHeight": "14px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                "headline-lg-mobile": ["20px", {"lineHeight": "28px", "fontWeight": "700"}],
                "headline-lg": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                "headline-xl": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}]
            }
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/container-queries')
    ],
};
