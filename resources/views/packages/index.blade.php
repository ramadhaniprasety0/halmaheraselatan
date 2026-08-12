<x-public-layout>
    <div class="pt-24 pb-12 bg-surface-container-low">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <h1 class="font-headline-xl text-headline-xl text-primary mb-4">{{ __('Curated Travel Packages') }}</h1>
            <p class="text-on-surface-variant font-body-lg mb-12 max-w-2xl">{{ __('All-inclusive experiences for your perfect getaway in South Halmahera.') }}</p>
            
            <!-- Packages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                @forelse($packages as $package)
                    <x-package-card :package="$package" />
                @empty
                    <div class="col-span-full py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-6xl mb-4 text-outline">tour</span>
                        <h3 class="font-headline-md">{{ __('No packages found') }}</h3>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div>
                {{ $packages->links() }}
            </div>
        </div>
    </div>
</x-public-layout>
