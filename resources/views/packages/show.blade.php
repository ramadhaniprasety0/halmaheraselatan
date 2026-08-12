<x-public-layout>
    <div class="w-full h-[50vh] bg-cover bg-center relative mt-16" style="background-image: url('{{ $package->image_url ?? 'https://via.placeholder.com/1200x800' }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-transparent"></div>
        <div class="absolute bottom-0 w-full px-margin-mobile md:px-margin-desktop py-12 max-w-container-max mx-auto">
            <span class="bg-brand-secondary text-white text-xs px-4 py-2 rounded-full font-bold uppercase tracking-wider mb-4 inline-block">{{ $package->theme }}</span>
            <h1 class="font-headline-xl text-4xl md:text-6xl text-primary font-bold text-shadow-premium text-white mb-2">{{ $package->name }}</h1>
        </div>
    </div>

    <div class="py-12 bg-surface">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white p-8 rounded-3xl border border-outline-variant shadow-sm mb-8">
                    <h2 class="font-headline-lg text-primary mb-4">{{ __('Package Overview') }}</h2>
                    <p class="text-on-surface-variant font-body-lg leading-relaxed mb-6">
                        {{ $package->description }}
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl border border-outline-variant shadow-sm mb-6 sticky top-24">
                    <h3 class="font-headline-md text-primary mb-4">{{ __('Booking Details') }}</h3>
                    <div class="text-primary font-bold text-headline-lg mb-6">Rp {{ number_format($package->price_per_pax, 0, ',', '.') }}<span class="text-sm font-normal text-on-surface-variant">/pax</span></div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-brand-secondary">schedule</span>
                            <div>
                                <strong class="block text-on-surface">{{ __('Duration') }}</strong>
                                <span class="text-on-surface-variant text-sm">{{ $package->duration_days }} {{ __('Days') }} / {{ $package->duration_nights }} {{ __('Nights') }}</span>
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
