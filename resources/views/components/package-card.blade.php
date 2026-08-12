@props(['package'])
<div class="group bg-white rounded-2xl p-3 shadow-sm border border-outline-variant hover:shadow-2xl transition-all">
    <div class="h-48 rounded-xl bg-cover bg-center mb-4 overflow-hidden" style="background-image: url('{{ $package->image_url ?: 'https://via.placeholder.com/400x300' }}')"></div>
    <div class="px-3 pb-3">
        <div class="flex justify-between items-center mb-3">
            <span class="text-brand-secondary font-bold text-sm">{{ $package->duration_days ?? '0' }} Days / {{ $package->duration_nights ?? '0' }} Nights</span>
            <div class="flex items-center gap-1 text-primary-container">
                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="font-bold text-sm">{{ $package->rating ?? '5.0' }}</span>
            </div>
        </div>
        <h3 class="text-xl font-bold mb-2">{{ $package->name ?? 'Package Name' }}</h3>
        <p class="text-on-surface-variant text-sm mb-5">{{ Str::limit($package->short_description ?? 'Description', 80) }}</p>
        <div class="flex items-center justify-between">
            <div class="text-primary font-bold text-xl">Rp {{ number_format($package->price_per_pax ?? 0, 0, ',', '.') }}<span class="text-sm font-normal text-on-surface-variant">/pax</span></div>
            <a href="/packages/{{ $package->slug ?? 'slug' }}" class="bg-brand-secondary text-white px-5 py-2 rounded-xl font-bold hover:bg-brand-secondary/90 text-sm">{{ __('Book Now') }}</a>
        </div>
    </div>
</div>