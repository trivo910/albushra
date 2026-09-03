import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bg: 'var(--color-bg)',
                surface: {
                    DEFAULT: 'var(--color-surface)',
                    muted: 'var(--color-surface-muted)',
                },
                ink: {
                    DEFAULT: 'var(--color-text)',
                    muted: 'var(--color-text-muted)',
                    faint: 'var(--color-text-faint)',
                },
                line: {
                    DEFAULT: 'var(--color-border)',
                    strong: 'var(--color-border-strong)',
                },
                accent: {
                    DEFAULT: 'var(--color-accent)',
                    hover: 'var(--color-accent-hover)',
                    soft: 'var(--color-accent-soft)',
                },
                danger: {
                    DEFAULT: 'var(--color-danger)',
                    soft: 'var(--color-danger-soft)',
                },
                status: {
                    'published-bg': 'var(--status-published-bg)',
                    published: 'var(--status-published-text)',
                    'draft-bg': 'var(--status-draft-bg)',
                    draft: 'var(--status-draft-text)',
                    'new-bg': 'var(--status-new-bg)',
                    new: 'var(--status-new-text)',
                    'contacted-bg': 'var(--status-contacted-bg)',
                    contacted: 'var(--status-contacted-text)',
                    'closed-bg': 'var(--status-closed-bg)',
                    closed: 'var(--status-closed-text)',
                },
                sidebar: {
                    DEFAULT: 'var(--sidebar-bg)',
                    text: 'var(--sidebar-text)',
                    muted: 'var(--sidebar-text-muted)',
                    active: 'var(--sidebar-text-active)',
                    'active-bg': 'var(--sidebar-bg-active)',
                    accent: 'var(--sidebar-accent)',
                    border: 'var(--sidebar-border)',
                },
            },
        },
    },
    plugins: [],
};
