<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500/50 disabled:opacity-25 transition-colors dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200']) }}>
    {{ $slot }}
</button>
