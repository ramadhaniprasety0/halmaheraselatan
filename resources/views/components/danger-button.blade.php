<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-2 rounded-lg bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/50 shadow-theme-xs whitespace-nowrap transition-colors dark:bg-red-600 dark:hover:bg-red-700']) }}>
    {{ $slot }}
</button>
