<x-public-layout>
    <main class="pt-24 pb-20">
        <!-- Breadcrumb & Header -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-6">
            <nav class="flex items-center gap-1.5 text-on-surface-variant dark:text-gray-400 text-xs mb-3">
                <a class="hover:text-primary transition-colors" href="/">{{ __('Home') }}</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-semibold">{{ __('Events') }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-3">
                <div class="max-w-2xl">
                    <h1 class="font-headline-xl text-headline-xl text-primary mb-6 leading-tight">{{ __('Festivals & Traditions') }}</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant dark:text-gray-400 mb-3">{{ __('Experience the soul of Halmahera Selatan through vibrant cultural celebrations, traditional boat races, and culinary festivals.') }}</p>
                </div>
            </div>
        </section>

        <!-- Filters Section -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-8">
            <form action="{{ route('events.index') }}" method="GET" class="bg-white dark:bg-white/[0.03] p-4 rounded-xl border border-outline-variant/20 dark:border-gray-800 flex flex-col md:flex-row gap-3 items-center shadow-sm">
                <div class="w-full md:flex-1 relative">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline dark:text-gray-400 text-[18px]">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white dark:placeholder:text-gray-500" placeholder="{{ __('Festival name or keyword...') }}" type="text"/>
                </div>
                <div class="flex flex-wrap md:flex-nowrap gap-2 w-full md:w-auto">
                    <select name="month" class="flex-1 md:w-32 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white">
                        <option value="">{{ __('Month') }}</option>
                    </select>
                    <select name="category" class="flex-1 md:w-32 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white">
                        <option value="">{{ __('Category') }}</option>
                    </select>
                    <select name="location" class="flex-1 md:w-32 py-2 bg-surface-container-low dark:bg-gray-800 border-none rounded-lg focus:ring-2 focus:ring-primary/20 text-sm dark:text-white">
                        <option value="">{{ __('Location') }}</option>
                    </select>
                    <button type="submit" class="w-full md:w-auto px-4 py-2 bg-brand-secondary text-white rounded-lg font-semibold text-sm flex items-center justify-center gap-1.5 hover:bg-brand-secondary/90 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">tune</span>
                        {{ __('Filters') }}
                    </button>
                    @if(request()->anyFilled(['search', 'month', 'category', 'location']))
                        <a href="{{ route('events.index') }}" class="w-full md:w-auto px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-on-surface dark:text-white rounded-lg font-semibold text-sm text-center flex items-center justify-center transition-colors">
                            {{ __('Reset') }}
                        </a>
                    @endif
                </div>
            </form>
        </section>

        <!-- Featured Event -->
        @if($featuredEvent)
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-12 mb-16">
            <h2 class="text-lg font-bold text-on-surface dark:text-white mb-6">{{ __('Happening Soon') }}</h2>
            <div class="group relative overflow-hidden rounded-2xl bg-white dark:bg-white/[0.03] border border-outline-variant/30 dark:border-gray-800 flex flex-col lg:flex-row shadow-md hover:shadow-lg transition-all duration-500">
                <div class="w-full lg:w-3/5 h-[220px] lg:h-[360px] relative overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $featuredEvent->image_url }}" alt="{{ $featuredEvent->name }}"/>
                    <div class="absolute top-4 left-4 px-3 py-1.5 bg-primary-container text-on-primary-container text-xs rounded-lg shadow-md font-bold">{{ __('FEATURED') }}</div>
                </div>
                <div class="w-full lg:w-2/5 p-6 lg:p-8 flex flex-col justify-center">
                    <div class="flex items-center gap-1.5 text-brand-secondary text-xs font-semibold mb-3">
                        <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                        <span>{{ \Carbon\Carbon::parse($featuredEvent->start_date)->format('M d, Y') }}</span>
                        <span class="mx-1.5">•</span>
                        <span>{{ $featuredEvent->location }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface dark:text-white mb-3">{{ $featuredEvent->name }}</h3>
                    <p class="text-xs leading-relaxed text-on-surface-variant dark:text-gray-300 mb-5 line-clamp-3">
                        {{ $featuredEvent->short_description }}
                    </p>
                    <a href="/events/{{ $featuredEvent->slug }}" class="w-full lg:w-fit px-6 py-2.5 bg-primary text-white rounded-lg font-bold text-sm hover:bg-primary/90 transition-all flex items-center justify-center gap-2 shadow-sm hover:scale-[0.98]">
                        {{ __('View Detailed Guide') }}
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <!-- Event Grid -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-24">
            <div class="flex justify-between items-end mb-6">
                <div>
                    <h3 class="text-lg font-bold text-on-surface dark:text-white">{{ __('Upcoming Events') }}</h3>
                    <p class="text-on-surface-variant dark:text-gray-400 text-xs">
                        {{ __('Showing') }} {{ $events->firstItem() ?? 0 }}-{{ $events->lastItem() ?? 0 }} {{ __('of') }} {{ $events->total() }} {{ __('results') }}
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
                @forelse($events as $event)
                <a href="/events/{{ $event->slug }}" class="group bg-white rounded-2xl border border-outline-variant/30 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full dark:bg-white/[0.03] dark:border-gray-800">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $event->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $event->name }}">
                        @if($event->category)
                        <div class="absolute top-3 right-3 bg-white/95 dark:bg-gray-900/95 glass-header px-2 py-0.5 rounded-full text-xs font-semibold flex items-center gap-1 shadow-sm text-secondary">{{ $event->category }}</div>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-1.5 mb-2 text-brand-secondary">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                            <span class="text-sm font-bold uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</span>
                        </div>
                        <h4 class="text-xl font-bold text-on-surface dark:text-white mb-2 group-hover:text-primary transition-colors line-clamp-1">{{ $event->name }}</h4>
                        <div class="flex items-center gap-1 text-on-surface-variant dark:text-gray-400 text-sm mb-4">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            {{ $event->location }}
                        </div>
                        <div class="mt-auto pt-3 border-t border-outline-variant/20 flex justify-between items-center dark:border-gray-800">
                            <span class="text-sm font-bold text-primary hover:translate-x-0.5 transition-transform flex items-center gap-1">
                                {{ __('View Details') }} <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                    <div class="col-span-full py-12 text-center text-on-surface-variant dark:text-gray-400">
                        <span class="material-symbols-outlined text-6xl mb-4 text-outline">event_busy</span>
                        <h3 class="text-base font-bold mb-1.5">{{ __('No events found') }}</h3>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $events->links() }}
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-20">
            <div class="bg-primary/5 rounded-[32px] p-8 md:p-12 flex flex-col items-center text-center relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <h2 class="text-2xl font-bold text-primary mb-3 relative z-10">{{ __('Never miss an event') }}</h2>
                <p class="text-sm leading-relaxed text-on-surface-variant dark:text-gray-400 mb-8 max-w-xl relative z-10">{{ __('Subscribe to our monthly newsletter to get exclusive early-bird event registrations and cultural insights from the Land of Kings.') }}</p>
                <form class="flex flex-col sm:flex-row gap-3 w-full max-w-md relative z-10" onsubmit="event.preventDefault(); alert('{{ __('Thank you for subscribing!') }}');">
                    <input class="flex-1 px-4 py-2.5 rounded-xl border border-outline-variant/50 focus:border-primary-container focus:ring-0 text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white" placeholder="{{ __('Enter your email address') }}" required type="email"/>
                    <button class="bg-primary text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-primary/90 shadow-sm hover:shadow-md transition-all whitespace-nowrap" type="submit">{{ __('Join Newsletter') }}</button>
                </form>
            </div>
        </section>
        
        <style>
            .glass-effect {
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            .event-card-hover:hover .event-image {
                transform: scale(1.05);
            }
        </style>
    </main>
</x-public-layout>
