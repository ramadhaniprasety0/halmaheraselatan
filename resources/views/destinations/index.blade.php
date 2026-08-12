<x-public-layout>
    <div class="pt-24 pb-16 bg-surface dark:bg-gray-900">
        <!-- Breadcrumbs & Header -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-6">
            <nav class="flex items-center gap-1.5 text-on-surface-variant dark:text-gray-400 text-xs mb-3">
                <a class="hover:text-primary transition-colors" href="/">{{ __('Home') }}</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-semibold">{{ __('Destinations') }}</span>
            </nav>
            <div class="max-w-2xl">
                <h1 class="font-headline-xl text-headline-xl text-primary mb-6 leading-tight">{{ __('Explore Destinations') }}</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant dark:text-gray-400 mb-10">
                    {{ __('Uncover the hidden gems of Halmahera Selatan. From pristine coral reefs and white sand beaches to historic spice route forts and lush tropical peaks, your journey through the Land of Kings begins here.') }}
                </p>
            </div>
        </section>

        <!-- Search & Filters -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-8">
            <form action="{{ route('destinations.index') }}" method="GET" class="bg-white dark:bg-white/[0.03] p-4 rounded-xl border border-outline-variant/20 dark:border-gray-800 flex flex-col md:flex-row gap-3 items-center shadow-sm">
                
                <!-- Category persistence -->
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <div class="w-full md:flex-1 relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline dark:text-gray-400 text-[18px]">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white dark:placeholder:text-gray-500" placeholder="{{ __('Search for island, beach, or historic site...') }}" type="text"/>
                </div>
                <div class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                    <select name="location" class="flex-1 md:w-36 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white">
                        <option value="Location">{{ __('Location') }}</option>
                        <option value="Bacan" {{ request('location') == 'Bacan' ? 'selected' : '' }}>Bacan Island</option>
                        <option value="Obi" {{ request('location') == 'Obi' ? 'selected' : '' }}>Obi Island</option>
                        <option value="Makian" {{ request('location') == 'Makian' ? 'selected' : '' }}>Makian Island</option>
                        <option value="Halmahera" {{ request('location') == 'Halmahera' ? 'selected' : '' }}>Halmahera Selatan</option>
                    </select>
                    <select name="rating" class="flex-1 md:w-36 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white">
                        <option value="Rating">{{ __('Rating') }}</option>
                        <option value="4.5" {{ request('rating') == '4.5' ? 'selected' : '' }}>4.5+ Stars</option>
                        <option value="4.0" {{ request('rating') == '4.0' ? 'selected' : '' }}>4.0+ Stars</option>
                    </select>
                    <button type="submit" class="w-full md:w-auto px-4 py-2 bg-brand-secondary text-white rounded-lg font-semibold text-sm flex items-center justify-center gap-1.5 hover:bg-brand-secondary/90 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">tune</span>
                        {{ __('Filters') }}
                    </button>
                    @if(request()->anyFilled(['search', 'location', 'rating', 'category']))
                        <a href="{{ route('destinations.index') }}" class="w-full md:w-auto px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-on-surface dark:text-white rounded-lg font-semibold text-sm text-center flex items-center justify-center transition-colors">
                            {{ __('Reset') }}
                        </a>
                    @endif
                </div>
            </form>

            <!-- Category Chips -->
            @php
                $currentCategory = request('category', 'All');
            @endphp
            <div class="flex gap-2 mt-4 overflow-x-auto pb-1.5 custom-scrollbar">
                <a href="{{ route('destinations.index', request()->except(['category', 'page'])) }}" 
                   class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $currentCategory === 'All' ? 'bg-primary text-white shadow-sm' : 'bg-brand-secondary/10 text-brand-secondary border border-brand-secondary/20 hover:bg-brand-secondary/20' }}">
                    {{ __('All Destinations') }}
                </a>
                <a href="{{ route('destinations.index', array_merge(request()->query(), ['category' => 'Pristine Beaches', 'page' => 1])) }}" 
                   class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $currentCategory === 'Pristine Beaches' ? 'bg-primary text-white shadow-sm' : 'bg-brand-secondary/10 text-brand-secondary border border-brand-secondary/20 hover:bg-brand-secondary/20' }}">
                    {{ __('Pristine Beaches') }}
                </a>
                <a href="{{ route('destinations.index', array_merge(request()->query(), ['category' => 'Diving & Snorkeling', 'page' => 1])) }}" 
                   class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $currentCategory === 'Diving & Snorkeling' ? 'bg-primary text-white shadow-sm' : 'bg-brand-secondary/10 text-brand-secondary border border-brand-secondary/20 hover:bg-brand-secondary/20' }}">
                    {{ __('Diving & Snorkeling') }}
                </a>
                <a href="{{ route('destinations.index', array_merge(request()->query(), ['category' => 'Cultural Heritage', 'page' => 1])) }}" 
                   class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $currentCategory === 'Cultural Heritage' ? 'bg-primary text-white shadow-sm' : 'bg-brand-secondary/10 text-brand-secondary border border-brand-secondary/20 hover:bg-brand-secondary/20' }}">
                    {{ __('Cultural Heritage') }}
                </a>
                <a href="{{ route('destinations.index', array_merge(request()->query(), ['category' => 'Rainforest Treks', 'page' => 1])) }}" 
                   class="whitespace-nowrap px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $currentCategory === 'Rainforest Treks' ? 'bg-primary text-white shadow-sm' : 'bg-brand-secondary/10 text-brand-secondary border border-brand-secondary/20 hover:bg-brand-secondary/20' }}">
                    {{ __('Rainforest Treks') }}
                </a>
            </div>
        </section>

        <!-- Featured Destination -->
        @if($featured && (!request('page') || request('page') == 1))
            @php
                $featIcon = 'explore';
                $featCat = $featured->category ?? 'Category';
                if ($featCat === 'Beaches') {
                    $featIcon = 'beach_access';
                } elseif ($featCat === 'Historical') {
                    $featIcon = 'history_edu';
                } elseif ($featCat === 'Diving') {
                    $featIcon = 'water';
                } elseif ($featCat === 'Nature') {
                    $featIcon = 'eco';
                } elseif ($featCat === 'Culture') {
                    $featIcon = 'festival';
                } elseif ($featCat === 'Adventure') {
                    $featIcon = 'explore';
                } elseif ($featCat === 'Waterfalls') {
                    $featIcon = 'tsunami';
                }
            @endphp
            <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-12">
                <div class="group relative overflow-hidden rounded-2xl bg-white dark:bg-white/[0.03] border border-outline-variant/30 dark:border-gray-800 flex flex-col lg:flex-row shadow-md hover:shadow-lg transition-all duration-500">
                    <div class="w-full lg:w-3/5 h-[220px] lg:h-[360px] relative overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $featured->image_url }}" alt="{{ $featured->name }}"/>
                        <div class="absolute top-4 left-4 px-3 py-1.5 bg-primary-container text-on-primary-container text-xs rounded-lg shadow-md font-bold">
                            {{ __('FEATURED DESTINATION') }}
                        </div>
                    </div>
                    <div class="w-full lg:w-2/5 p-6 lg:p-8 flex flex-col justify-center">
                        <div class="flex items-center gap-1.5 text-brand-secondary text-xs font-semibold mb-3">
                            <span class="material-symbols-outlined text-[16px]">star_rate</span>
                            <span>{{ number_format($featured->rating ?? 5.0, 1) }} ({{ $featured->review_count ?? 0 }} {{ __('Reviews') }})</span>
                            <span class="mx-1.5">•</span>
                            <span>{{ $featured->location }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-on-surface dark:text-white mb-3">{{ $featured->name }}</h2>
                        <p class="text-xs leading-relaxed text-on-surface-variant dark:text-gray-300 mb-5">
                            {{ $featured->short_description ?? Str::limit($featured->description, 160) }}
                        </p>
                        <div class="flex flex-wrap gap-3 mb-6">
                            <div class="flex items-center gap-1.5 bg-surface-container-high dark:bg-gray-800 px-3 py-1.5 rounded-lg">
                                <span class="material-symbols-outlined text-primary text-[16px]">{{ $featIcon }}</span>
                                <span class="text-xs font-medium dark:text-gray-300">{{ $featCat }}</span>
                            </div>
                        </div>
                        <a href="/destinations/{{ $featured->slug }}" class="w-full lg:w-fit px-6 py-2.5 bg-primary text-white rounded-lg font-bold text-sm hover:bg-primary/90 transition-all flex items-center justify-center gap-2 shadow-sm hover:scale-[0.98]">
                            {{ __('View Detailed Guide') }}
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- Destination Grid -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-16">
            <div class="flex justify-between items-end mb-6">
                <div>
                    <h3 class="text-lg font-bold text-on-surface dark:text-white">{{ __('Browse All Destinations') }}</h3>
                    <p class="text-on-surface-variant dark:text-gray-400 text-xs">
                        {{ __('Showing') }} {{ $destinations->firstItem() ?? 0 }}-{{ $destinations->lastItem() ?? 0 }} {{ __('of') }} {{ $destinations->total() }} {{ __('locations') }}
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($destinations as $destination)
                    <x-destination-card :destination="$destination" />
                @empty
                    <div class="col-span-full py-12 text-center text-on-surface-variant dark:text-gray-400">
                        <span class="material-symbols-outlined text-5xl mb-3 text-outline">search_off</span>
                        <h3 class="text-base font-bold mb-1.5">{{ __('No destinations found') }}</h3>
                        <p class="text-xs">{{ __('Try adjusting your filters or search terms.') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $destinations->links() }}
            </div>
        </section>
    </div>
</x-public-layout>
