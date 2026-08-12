@props(['destination'])
@php
    $icon = 'explore';
    $cat = $destination->category ?? 'Category';
    if ($cat === 'Beaches') {
        $icon = 'beach_access';
    } elseif ($cat === 'Historical') {
        $icon = 'history_edu';
    } elseif ($cat === 'Diving') {
        $icon = 'water';
    } elseif ($cat === 'Nature') {
        $icon = 'eco';
    } elseif ($cat === 'Culture') {
        $icon = 'festival';
    } elseif ($cat === 'Adventure') {
        $icon = 'explore';
    } elseif ($cat === 'Waterfalls') {
        $icon = 'tsunami';
    }
@endphp
<div class="group bg-white rounded-2xl border border-outline-variant/30 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full dark:bg-white/[0.03] dark:border-gray-800">
    <div class="relative h-48 overflow-hidden">
        <img src="{{ $destination->image_url ?? 'https://via.placeholder.com/400x300' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $destination->name }}">
        <div class="absolute top-3 right-3 bg-white/95 dark:bg-gray-900/95 glass-header px-2 py-0.5 rounded-full text-xs font-semibold flex items-center gap-1 shadow-sm">
            <span class="material-symbols-outlined text-[14px] text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
            <span class="text-on-surface dark:text-white">{{ number_format($destination->rating ?? 5.0, 1) }}</span>
        </div>
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <div class="flex items-center gap-1.5 mb-2">
            <span class="material-symbols-outlined text-[18px] text-brand-secondary">{{ $icon }}</span>
            <span class="text-sm font-bold text-brand-secondary uppercase tracking-wider">{{ $cat }}</span>
        </div>
        <h4 class="text-xl font-bold text-on-surface dark:text-white mb-2 group-hover:text-primary transition-colors line-clamp-1">{{ $destination->name }}</h4>
        <div class="flex items-center gap-1 text-on-surface-variant dark:text-gray-400 text-sm mb-3">
            <span class="material-symbols-outlined text-[16px]">location_on</span>
            {{ $destination->location }}
        </div>
        <p class="text-sm leading-relaxed text-on-surface-variant dark:text-gray-300 line-clamp-2 mb-4">
            {{ $destination->short_description ?? Str::limit($destination->description, 100) }}
        </p>
        <div class="mt-auto pt-3 border-t border-outline-variant/20 flex justify-between items-center dark:border-gray-800">
            <a href="/destinations/{{ $destination->slug }}" class="text-sm font-bold text-primary hover:translate-x-0.5 transition-transform flex items-center gap-1">
                {{ __('View Detail') }} <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
    </div>
</div>