<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div wire:poll.10s class="inline-flex flex-col items-center">
        <span class="material-symbols-outlined text-primary text-headline-lg mb-4">group</span>
        <h2 class="font-headline-xl text-headline-xl text-primary tracking-tighter mb-2">{{ number_format($count, 0, ',', '.') }}</h2>
        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest">{{ __('Total Website Visitors') }}</p>
    </div>
</div>
