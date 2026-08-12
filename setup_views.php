<?php

$accIndex = <<<'HTML'
<x-public-layout>
    <div class="pt-24 pb-12 bg-surface-container-low">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <h1 class="font-headline-xl text-headline-xl text-primary mb-4">{{ __('Find Accommodations') }}</h1>
            <p class="text-on-surface-variant font-body-lg mb-12 max-w-2xl">{{ __('Rest and recharge in our curated list of comfortable stays, ranging from luxury resorts to local homestays.') }}</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter mb-12">
                @forelse($accommodations as $acc)
                    <a href="{{ route('accommodations.show', $acc->slug) }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-outline-variant hover:shadow-xl transition-all block">
                        <div class="w-full aspect-[4/3] bg-surface-container relative overflow-hidden">
                            <img src="{{ $acc->image_url ?? 'https://via.placeholder.com/600x450' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-bold text-primary flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span> {{ $acc->rating }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-secondary text-xs font-bold uppercase tracking-wider mb-2">{{ $acc->type }}</div>
                            <h3 class="font-headline-md text-primary mb-2 line-clamp-1">{{ $acc->name }}</h3>
                            <div class="flex items-center text-on-surface-variant text-sm mb-4">
                                <span class="material-symbols-outlined text-[16px] mr-1">location_on</span> {{ $acc->location }}
                            </div>
                            <div class="font-bold text-primary text-lg">Rp {{ number_format($acc->price_per_night, 0, ',', '.') }}<span class="text-sm font-normal text-on-surface-variant">/night</span></div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-6xl mb-4 text-outline">hotel</span>
                        <h3 class="font-headline-md">{{ __('No accommodations found') }}</h3>
                    </div>
                @endforelse
            </div>
            
            <div>{{ $accommodations->links() }}</div>
        </div>
    </div>
</x-public-layout>
HTML;
file_put_contents('c:\laragon\www\halsea\resources\views\accommodations\index.blade.php', $accIndex);


$accShow = <<<'HTML'
<x-public-layout>
    <div class="w-full h-[50vh] bg-cover bg-center relative mt-16" style="background-image: url('{{ $accommodation->image_url ?? 'https://via.placeholder.com/1200x800' }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-transparent"></div>
        <div class="absolute bottom-0 w-full px-margin-mobile md:px-margin-desktop py-12 max-w-container-max mx-auto">
            <span class="bg-secondary text-white text-xs px-4 py-2 rounded-full font-bold uppercase tracking-wider mb-4 inline-block">{{ $accommodation->type }}</span>
            <h1 class="font-headline-xl text-4xl md:text-6xl text-primary font-bold text-shadow-premium text-white mb-2">{{ $accommodation->name }}</h1>
        </div>
    </div>
    <div class="py-12 bg-surface">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="bg-white p-8 rounded-3xl border border-outline-variant shadow-sm mb-8">
                    <h2 class="font-headline-lg text-primary mb-4">{{ __('About') }}</h2>
                    <p class="text-on-surface-variant font-body-lg leading-relaxed mb-6">{{ $accommodation->description }}</p>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm mb-6 sticky top-24">
                    <div class="text-primary font-bold text-headline-lg mb-6">Rp {{ number_format($accommodation->price_per_night, 0, ',', '.') }}<span class="text-sm font-normal text-on-surface-variant">/night</span></div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary">location_on</span>
                            <div>
                                <strong class="block text-on-surface">{{ __('Location') }}</strong>
                                <span class="text-on-surface-variant text-sm">{{ $accommodation->location }}</span>
                            </div>
                        </li>
                    </ul>
                    <button class="mt-8 block w-full text-center bg-primary-container text-on-primary font-bold py-3 rounded-xl shadow-md hover:scale-105 transition-all">
                        {{ __('Book Now') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
HTML;
file_put_contents('c:\laragon\www\halsea\resources\views\accommodations\show.blade.php', $accShow);


$culIndex = <<<'HTML'
<x-public-layout>
    <div class="pt-24 pb-12 bg-surface-container-low">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <h1 class="font-headline-xl text-headline-xl text-primary mb-4">{{ __('Culinary Highlights') }}</h1>
            <p class="text-on-surface-variant font-body-lg mb-12 max-w-2xl">{{ __('Taste the authentic flavors of South Halmahera, from fresh seafood to traditional spices.') }}</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-12">
                @forelse($culinaries as $cul)
                    <a href="{{ route('culinary.show', $cul->slug) }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-outline-variant hover:shadow-xl transition-all block">
                        <div class="w-full aspect-square bg-surface-container relative overflow-hidden">
                            <img src="{{ $cul->image_url ?? 'https://via.placeholder.com/400x400' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-6">
                            <div class="text-secondary text-xs font-bold uppercase tracking-wider mb-2">{{ $cul->category }}</div>
                            <h3 class="font-headline-md text-primary mb-2 line-clamp-1">{{ $cul->name }}</h3>
                            <div class="font-bold text-on-surface">Rp {{ number_format($cul->price_range_start, 0, ',', '.') }} - Rp {{ number_format($cul->price_range_end, 0, ',', '.') }}</div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-6xl mb-4 text-outline">restaurant</span>
                        <h3 class="font-headline-md">{{ __('No culinary spots found') }}</h3>
                    </div>
                @endforelse
            </div>
            
            <div>{{ $culinaries->links() }}</div>
        </div>
    </div>
</x-public-layout>
HTML;
file_put_contents('c:\laragon\www\halsea\resources\views\culinary\index.blade.php', $culIndex);

$culShow = <<<'HTML'
<x-public-layout>
    <div class="pt-24 pb-12 bg-surface">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="w-full aspect-[16/9] bg-cover bg-center rounded-3xl mb-8" style="background-image: url('{{ $culinary->image_url ?? 'https://via.placeholder.com/800x450' }}')"></div>
                <span class="bg-secondary text-white text-xs px-4 py-2 rounded-full font-bold uppercase tracking-wider mb-4 inline-block">{{ $culinary->category }}</span>
                <h1 class="font-headline-xl text-primary font-bold mb-4">{{ $culinary->name }}</h1>
                <div class="bg-white p-8 rounded-3xl border border-outline-variant shadow-sm mb-8 mt-6">
                    <h2 class="font-headline-lg text-primary mb-4">{{ __('About') }}</h2>
                    <p class="text-on-surface-variant font-body-lg leading-relaxed mb-6">{{ $culinary->description }}</p>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm mb-6 sticky top-24">
                    <h3 class="font-headline-md text-primary mb-4">{{ __('Details') }}</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary">payments</span>
                            <div>
                                <strong class="block text-on-surface">{{ __('Price Range') }}</strong>
                                <span class="text-on-surface-variant text-sm">Rp {{ number_format($culinary->price_range_start, 0, ',', '.') }} - Rp {{ number_format($culinary->price_range_end, 0, ',', '.') }}</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary">location_on</span>
                            <div>
                                <strong class="block text-on-surface">{{ __('Location') }}</strong>
                                <span class="text-on-surface-variant text-sm">{{ $culinary->location }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
HTML;
file_put_contents('c:\laragon\www\halsea\resources\views\culinary\show.blade.php', $culShow);

echo "Public views for Accommodations and Culinary created.";
