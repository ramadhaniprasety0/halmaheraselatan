<x-public-layout>
    <div class="pt-24 pb-12 bg-surface">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="w-full aspect-[16/9] bg-cover bg-center rounded-3xl mb-8" style="background-image: url('{{ $culinary->image_url ?? 'https://via.placeholder.com/800x450' }}')"></div>
                <span class="bg-brand-secondary text-white text-xs px-4 py-2 rounded-full font-bold uppercase tracking-wider mb-4 inline-block">{{ $culinary->category }}</span>
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
                            <span class="material-symbols-outlined text-brand-secondary">payments</span>
                            <div>
                                <strong class="block text-on-surface">{{ __('Price Range') }}</strong>
                                <span class="text-on-surface-variant text-sm">Rp {{ number_format($culinary->price_range_start, 0, ',', '.') }} - Rp {{ number_format($culinary->price_range_end, 0, ',', '.') }}</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-brand-secondary">location_on</span>
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