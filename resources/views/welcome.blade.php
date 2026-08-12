<x-public-layout>
    <!-- Section 2: Hero Section -->
    <header class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB0vHInxTTLqlm7XL7gTpwV3EV6x-FCQ1Eznn3wytmGUgAnCIgWZr7RYXIEE-Yz2ypKYtkYzhGz4vF-k977WWNmtTIgGRT3M9GqxXjAFKYguooRv7w54gdEtd0Gbp-K9vmpVASV7mH0etyCe4udZYRqQyCpzfj4-xGBJHeYOTcIpjk3sviPps88PbJDK-XEF2FBVe0EafNkaFMhTC22XJCxxC0S3QJZXnLTwZXx7F9C-bJzUPGDLVpPKMZ2tgiKgx6wEdd5FMPkmSY')"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-surface via-surface/40 to-transparent"></div>
        </div>
        <div class="relative z-10 px-margin-mobile md:px-margin-desktop w-full max-w-container-max mx-auto">
            <div class="max-w-2xl">
                <h1 class="font-headline-xl text-headline-xl text-primary mb-6 animate-fade-in leading-tight">Explore the Beauty of <br/><span class="text-brand-secondary">South Halmahera</span></h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-lg">{{ __('Discover the untouched beauty') }}</p>
                <div class="flex flex-wrap gap-4">
                    <a href="/destinations" class="bg-primary-container text-on-primary font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-primary-container/20 hover:translate-y-[-2px] transition-all inline-block">{{ __('Explore Destinations') }}</a>
                    <a href="/packages" class="bg-white border-2 border-brand-secondary text-brand-secondary font-bold px-8 py-4 rounded-xl hover:bg-brand-secondary/5 transition-all inline-block">{{ __('View Travel Packages') }}</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Section 3: Tourism Categories -->
    <section class="py-24 bg-surface-container-low">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-2">{{ __('Tourism Categories') }}</h2>
                    <p class="text-on-surface-variant font-body-md">{{ __('Find your perfect destination by category') }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <!-- Categories -->
                <a href="/destinations?category=Beaches" class="group bg-white p-8 rounded-2xl border border-outline-variant hover:border-primary transition-all text-center cursor-pointer hover:shadow-xl hover:translate-y-[-8px] block">
                    <div class="w-16 h-16 bg-brand-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-secondary transition-colors">
                        <span class="material-symbols-outlined text-brand-secondary group-hover:text-white">beach_access</span>
                    </div>
                    <span class="font-label-md text-label-md text-on-surface">{{ __('Beaches & Islands') }}</span>
                </a>
                <a href="/destinations?category=Historical" class="group bg-white p-8 rounded-2xl border border-outline-variant hover:border-primary transition-all text-center cursor-pointer hover:shadow-xl hover:translate-y-[-8px] block">
                    <div class="w-16 h-16 bg-brand-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-secondary transition-colors">
                        <span class="material-symbols-outlined text-brand-secondary group-hover:text-white">castle</span>
                    </div>
                    <span class="font-label-md text-label-md text-on-surface">{{ __('Historical Sites') }}</span>
                </a>
                <a href="/destinations?category=Nature" class="group bg-white p-8 rounded-2xl border border-outline-variant hover:border-primary transition-all text-center cursor-pointer hover:shadow-xl hover:translate-y-[-8px] block">
                    <div class="w-16 h-16 bg-brand-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-secondary transition-colors">
                        <span class="material-symbols-outlined text-brand-secondary group-hover:text-white">forest</span>
                    </div>
                    <span class="font-label-md text-label-md text-on-surface">{{ __('Nature & Wildlife') }}</span>
                </a>
                <a href="/destinations?category=Culture" class="group bg-white p-8 rounded-2xl border border-outline-variant hover:border-primary transition-all text-center cursor-pointer hover:shadow-xl hover:translate-y-[-8px] block">
                    <div class="w-16 h-16 bg-brand-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-secondary transition-colors">
                        <span class="material-symbols-outlined text-brand-secondary group-hover:text-white">theater_comedy</span>
                    </div>
                    <span class="font-label-md text-label-md text-on-surface">{{ __('Culture & Heritage') }}</span>
                </a>
                <a href="/destinations?category=Waterfalls" class="group bg-white p-8 rounded-2xl border border-outline-variant hover:border-primary transition-all text-center cursor-pointer hover:shadow-xl hover:translate-y-[-8px] block">
                    <div class="w-16 h-16 bg-brand-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-secondary transition-colors">
                        <span class="material-symbols-outlined text-brand-secondary group-hover:text-white">waterfall_chart</span>
                    </div>
                    <span class="font-label-md text-label-md text-on-surface">{{ __('Waterfalls') }}</span>
                </a>
                <a href="/destinations?category=Diving" class="group bg-white p-8 rounded-2xl border border-outline-variant hover:border-primary transition-all text-center cursor-pointer hover:shadow-xl hover:translate-y-[-8px] block">
                    <div class="w-16 h-16 bg-brand-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-brand-secondary transition-colors">
                        <span class="material-symbols-outlined text-brand-secondary group-hover:text-white">scuba_diving</span>
                    </div>
                    <span class="font-label-md text-label-md text-on-surface">{{ __('Diving Spots') }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 4: Popular Destinations -->
    <section class="py-24">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-2">{{ __('Popular Destinations') }}</h2>
            <p class="text-on-surface-variant font-body-md mb-12">{{ __('Must-visit places in South Halmahera') }}</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
                @foreach($destinations as $destination)
                    <x-destination-card :destination="$destination" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 5: Upcoming Events -->
    <section class="py-24 bg-surface-container">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center justify-between mb-12">
                <h2 class="font-headline-lg text-headline-lg text-primary">{{ __('Upcoming Events') }}</h2>
                <a href="/events" class="text-brand-secondary font-bold hover:underline flex items-center">View All Events <span class="material-symbols-outlined ml-1">arrow_forward</span></a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                @foreach($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 6: Recommended Travel Packages -->
    <section class="py-24">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-12 text-center">{{ __('Curated Travel Packages') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($packages as $package)
                    <x-package-card :package="$package" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 7: Interactive Map Preview -->
    <section class="py-24 bg-surface-container-high relative overflow-hidden">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
                <div class="lg:col-span-4">
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-6">{{ __('Interactive Tourist Map') }}</h2>
                    <p class="text-on-surface-variant mb-8">{{ __('Explore locations visually and plan your route') }}</p>
                    <a href="/map" class="block text-center w-full bg-primary-container text-on-primary font-bold py-4 rounded-xl shadow-md">{{ __('Open Full Map') }}</a>
                </div>
                <div class="lg:col-span-8 relative">
                    <div class="bg-white p-4 rounded-3xl shadow-2xl border border-outline-variant aspect-[16/10] overflow-hidden group">
                        <div class="w-full h-full rounded-2xl overflow-hidden relative">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDWohnOyJNWel5WitGIBpmYMy9GYkOWFON2c6KlPW2bUJT8KfHnOh-GC2tMTqAeKBnGgGal0uqijL5f1yYNq1pEPUdX096vDaDBUvqajn6fRLD7ydeNe6x4TmYxYXYNzq0r5zPZw42fLrXJhjSMluuBDlPX7ScAaO5vL0IyU2GRKIECuS0KJ_3QIi59Pw457q84iaJ-zZ_bDW-VJy-36xf5WclI0vrMOPEbcWaRWw41sU0d7wLO2SpjRMD9npGI6Y3atAgptSDmD0" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 8: Visitor Reviews -->
    <section class="py-24 bg-surface">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                <div class="lg:col-span-8 flex flex-col">
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-2">What Our Visitors Say</h2>
                    <p class="text-on-surface-variant font-body-md mb-8">Read authentic experiences from travelers who have explored South Halmahera.</p>
                    <div class="h-[420px]">
                        <livewire:review-carousel />
                    </div>
                </div>
                <div class="lg:col-span-4 flex flex-col">
                    <livewire:submit-review />
                </div>
            </div>
        </div>
    </section>

    <!-- Section 9: Newsletter -->
    <section class="py-24 pt-0 bg-surface">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <livewire:newsletter-form />
        </div>
    </section>

    <!-- Visitor Counter -->
    <section class="py-16 bg-surface-container border-t border-outline-variant">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-center">
            <livewire:visitor-counter />
        </div>
    </section>

</x-public-layout>
