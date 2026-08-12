<x-public-layout>
    <main class="pt-24 pb-20">
        <!-- Breadcrumb & Header Section -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-8">
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-6">
                <a class="hover:text-primary transition-colors" href="/">{{ __('Home') }}</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="#">{{ __('Explore') }}</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-semibold">{{ __('Accommodations') }}</span>
            </nav>
            <div class="max-w-3xl">
                <h1 class="font-headline-xl text-[36px] md:text-headline-xl leading-tight text-on-surface mb-4">{{ __('Discover Your Haven in the Land of Kings') }}</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant">{{ __('From overwater luxury villas to eco-conscious jungle retreats, find the perfect base for your Halmahera Selatan adventure.') }}</p>
            </div>
        </section>

        <!-- Dynamic Search Bar Section -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-12">
            <form action="{{ route('accommodations.index') }}" method="GET" class="bg-surface-container-lowest border border-outline-variant p-2 md:p-3 rounded-2xl shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
                    <!-- Search -->
                    <div class="p-3 hover:bg-surface-container-low rounded-xl transition-colors group md:col-span-2">
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1 group-hover:text-primary">{{ __('Search') }}</label>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">search</span>
                            <input name="search" value="{{ request('search') }}" class="bg-transparent border-none p-0 focus:ring-0 font-label-md text-label-md text-on-surface w-full" type="text" placeholder="{{ __('Hotel, Villa, or Location...') }}"/>
                        </div>
                    </div>
                    <!-- Type -->
                    <div class="p-3 hover:bg-surface-container-low rounded-xl transition-colors group">
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1 group-hover:text-primary">{{ __('Type') }}</label>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">home_work</span>
                            <select name="type" class="bg-transparent border-none p-0 focus:ring-0 font-label-md text-label-md text-on-surface w-full">
                                <option value="">{{ __('All Types') }}</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Sort -->
                    <div class="p-3 hover:bg-surface-container-low rounded-xl transition-colors group">
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1 group-hover:text-primary">{{ __('Sort By') }}</label>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">sort</span>
                            <select name="sort" class="bg-transparent border-none p-0 focus:ring-0 font-label-md text-label-md text-on-surface w-full">
                                <option value="">{{ __('Recommended') }}</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Top Rated') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- Search Button -->
                    <div class="flex items-center p-2">
                        <button type="submit" class="w-full h-full bg-primary-container text-on-primary rounded-xl flex items-center justify-center gap-2 hover:bg-primary transition-colors shadow-md min-h-[48px]">
                            <span class="material-symbols-outlined">search</span>
                            <span class="font-label-md text-label-md">{{ __('Search') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Featured Accommodation (Asymmetric Bento Style) -->
        @if($featuredAccommodation)
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-20">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">{{ __('The Pearl of the Maluku Sea') }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ __('Our hand-picked sanctuary for the ultimate island experience.') }}</p>
                </div>
                <a href="{{ route('accommodations.show', $featuredAccommodation->slug) }}" class="hidden md:flex items-center gap-2 text-primary font-label-md text-label-md group">
                    {{ __('View Highlight Details') }}
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
                <a href="{{ route('accommodations.show', $featuredAccommodation->slug) }}" class="md:col-span-8 relative h-[500px] rounded-3xl overflow-hidden shadow-lg group block">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $featuredAccommodation->image_url }}" alt="{{ $featuredAccommodation->name }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-10 text-white">
                        <span class="bg-secondary text-white px-4 py-1.5 rounded-full text-label-sm font-label-sm w-fit mb-4">{{ __('Limited Availability') }}</span>
                        <h3 class="font-headline-xl text-headline-lg-mobile md:text-headline-xl mb-2">{{ $featuredAccommodation->name }}</h3>
                        <p class="font-body-lg text-body-lg max-w-xl opacity-90">{{ $featuredAccommodation->short_description }}</p>
                        <div class="flex items-center gap-6 mt-6">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-fixed-dim" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-label-md text-label-md">{{ $featuredAccommodation->rating }} ({{ $featuredAccommodation->review_count }} {{ __('Reviews') }})</span>
                            </div>
                            <div class="font-label-md text-label-md">{{ __('From') }} IDR {{ number_format($featuredAccommodation->price_per_night, 0, ',', '.') }}/{{ __('night') }}</div>
                        </div>
                    </div>
                </a>
                <div class="md:col-span-4 flex flex-col gap-gutter">
                    <div class="flex-1 bg-secondary-container/30 p-8 rounded-3xl border border-secondary/10 flex flex-col justify-center">
                        <span class="material-symbols-outlined text-secondary text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">eco</span>
                        <h4 class="font-headline-md text-headline-md text-secondary mb-2">{{ __('Sustainable Luxury') }}</h4>
                        <p class="font-body-md text-body-md text-on-secondary-container">{{ __('100% solar powered retreat with coral restoration programs in your backyard.') }}</p>
                    </div>
                    <div class="flex-1 bg-surface-container-high p-8 rounded-3xl border border-outline-variant relative overflow-hidden group">
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-primary text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">spa</span>
                            <h4 class="font-headline-md text-headline-md text-on-surface mb-2">{{ __('Spa & Wellness') }}</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant">{{ __('Traditional Moluccan healing treatments using island-grown spices and minerals.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Accommodation Grid Section -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-24">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">{{ __('Browse All Sanctuaries') }}</h2>
                    <p class="text-on-surface-variant font-label-md text-label-md mt-1">
                        {{ __('Showing') }} {{ $accommodations->firstItem() ?? 0 }}-{{ $accommodations->lastItem() ?? 0 }} {{ __('of') }} {{ $accommodations->total() }} {{ __('results') }}
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
                @forelse($accommodations as $acc)
                <!-- Accommodation Card -->
                <a href="{{ route('accommodations.show', $acc->slug) }}" class="bg-surface-container-lowest rounded-2xl border border-outline-variant overflow-hidden card-hover transition-all duration-300 block group">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $acc->image_url }}" alt="{{ $acc->name }}"/>
                        <button class="absolute top-4 right-4 bg-white/20 backdrop-blur-md p-2 rounded-full text-white hover:bg-white hover:text-primary transition-all" onclick="event.preventDefault();">
                            <span class="material-symbols-outlined">favorite</span>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ $acc->location }}</span>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-primary-container text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-label-sm text-label-sm font-bold">{{ $acc->rating }}</span>
                            </div>
                        </div>
                        <h3 class="font-headline-md text-[20px] text-on-surface mb-3 line-clamp-1">{{ $acc->name }}</h3>
                        <p class="font-body-md text-label-sm text-on-surface-variant mb-4 line-clamp-2">{{ $acc->short_description }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                            <div>
                                <span class="font-headline-md text-primary text-[20px]">IDR {{ number_format($acc->price_per_night, 0, ',', '.') }}</span>
                                <span class="text-on-surface-variant font-label-sm text-label-sm">/{{ __('night') }}</span>
                            </div>
                            <span class="bg-primary/5 text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-xl transition-all font-label-md text-label-md">{{ __('Book Now') }}</span>
                        </div>
                    </div>
                </a>
                @empty
                    <div class="col-span-full py-12 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-6xl mb-4 text-outline">hotel</span>
                        <h3 class="text-base font-bold mb-1.5">{{ __('No accommodations found') }}</h3>
                        <p class="text-sm">{{ __('Try adjusting your search or filters.') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $accommodations->links() }}
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-32">
            <div class="relative bg-primary overflow-hidden rounded-[32px] p-8 md:p-16 text-center md:text-left">
                <!-- Abstract Design Elements -->
                <div class="absolute top-0 right-0 w-1/2 h-full bg-primary-container/20 -skew-x-12 translate-x-1/4"></div>
                <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-white/5 rounded-full blur-3xl"></div>
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 items-center gap-12">
                    <div>
                        <h2 class="font-headline-xl text-headline-lg-mobile md:text-headline-xl text-white mb-4">{{ __('Join the Inner Circle') }}</h2>
                        <p class="font-body-lg text-body-lg text-white/80 max-w-md">{{ __('Subscribe to our newsletter and be the first to receive exclusive seasonal offers and hidden travel guides of Halmahera Selatan.') }}</p>
                    </div>
                    <form class="flex flex-col sm:flex-row gap-4" onsubmit="event.preventDefault(); alert('{{ __('Thank you for subscribing!') }}');">
                        <input class="flex-1 px-8 py-4 rounded-2xl bg-white border-none focus:ring-4 focus:ring-white/30 text-on-surface font-body-md text-body-md" placeholder="{{ __('Your email address') }}" required type="email"/>
                        <button class="px-10 py-4 bg-on-background text-white rounded-2xl font-label-md text-label-md hover:scale-105 transition-transform active:scale-95 whitespace-nowrap" type="submit">{{ __('Subscribe Now') }}</button>
                    </form>
                </div>
            </div>
        </section>

        <style>
            .card-hover:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 30px -10px rgba(0, 107, 84, 0.08);
            }
        </style>
    </main>
</x-public-layout>