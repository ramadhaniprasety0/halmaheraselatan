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
                            <div class="text-brand-secondary text-xs font-bold uppercase tracking-wider mb-2">{{ $cul->category }}</div>
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