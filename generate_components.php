<?php

$componentsDir = 'c:\laragon\www\halsea\resources\views\components\\';
if (!is_dir($componentsDir)) mkdir($componentsDir, 0755, true);

$destinationCard = <<<'HTML'
@props(['destination'])
<a href="/destinations/{{ $destination->slug ?? 'slug' }}" class="group relative h-[450px] rounded-2xl overflow-hidden cursor-pointer shadow-lg block">
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" style="background-image: url('{{ $destination->image_url ?? 'https://via.placeholder.com/400x600' }}')"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
    <div class="absolute bottom-0 left-0 p-6">
        <span class="bg-secondary text-white text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider mb-2 inline-block">{{ $destination->category ?? 'Category' }}</span>
        <h3 class="text-white font-headline-md text-headline-md mb-2">{{ $destination->name ?? 'Destination Name' }}</h3>
        <div class="flex items-center text-white/80 font-label-sm text-label-sm">
            <span class="material-symbols-outlined text-sm mr-1">location_on</span> {{ $destination->location ?? 'Location' }}
        </div>
    </div>
</a>
HTML;
file_put_contents($componentsDir . 'destination-card.blade.php', $destinationCard);

$eventCard = <<<'HTML'
@props(['event'])
<a href="/events/{{ $event->slug ?? 'slug' }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all block">
    <div class="h-48 bg-cover bg-center" style="background-image: url('{{ $event->image_url ?? 'https://via.placeholder.com/400x300' }}')"></div>
    <div class="p-6">
        <div class="text-primary font-bold text-label-sm mb-2">{{ $event->date_formatted ?? 'Date' }}</div>
        <h3 class="font-headline-md text-headline-md text-on-surface mb-3">{{ $event->name ?? 'Event Name' }}</h3>
        <p class="text-on-surface-variant font-body-md mb-4">{{ Str::limit($event->short_description ?? 'Description', 80) }}</p>
        <button class="text-primary font-bold hover:gap-2 transition-all flex items-center">{{ __('Learn More') }} <span class="material-symbols-outlined ml-2">east</span></button>
    </div>
</a>
HTML;
file_put_contents($componentsDir . 'event-card.blade.php', $eventCard);

$packageCard = <<<'HTML'
@props(['package'])
<div class="group bg-white rounded-3xl p-4 shadow-sm border border-outline-variant hover:shadow-2xl transition-all">
    <div class="h-64 rounded-2xl bg-cover bg-center mb-6 overflow-hidden" style="background-image: url('{{ $package->image_url ?? 'https://via.placeholder.com/400x300' }}')"></div>
    <div class="px-4 pb-4">
        <div class="flex justify-between items-center mb-4">
            <span class="text-secondary font-bold text-label-md">{{ $package->duration_days ?? '0' }} Days / {{ $package->duration_nights ?? '0' }} Nights</span>
            <div class="flex items-center gap-1 text-primary-container">
                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="font-bold text-label-md">{{ $package->rating ?? '5.0' }}</span>
            </div>
        </div>
        <h3 class="font-headline-md text-headline-md mb-2">{{ $package->name ?? 'Package Name' }}</h3>
        <p class="text-on-surface-variant font-body-md mb-6">{{ Str::limit($package->short_description ?? 'Description', 80) }}</p>
        <div class="flex items-center justify-between">
            <div class="text-primary font-bold text-headline-md">Rp {{ number_format($package->price_per_pax ?? 0, 0, ',', '.') }}<span class="text-sm font-normal text-on-surface-variant">/pax</span></div>
            <a href="/packages/{{ $package->slug ?? 'slug' }}" class="bg-secondary text-white px-6 py-2 rounded-xl font-bold hover:bg-secondary/90">{{ __('Book Now') }}</a>
        </div>
    </div>
</div>
HTML;
file_put_contents($componentsDir . 'package-card.blade.php', $packageCard);

echo "Components created.";
