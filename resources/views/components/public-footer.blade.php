<footer class="bg-surface-container-highest border-t border-outline-variant rounded-t-xl mt-24">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-margin-desktop py-20 max-w-container-max mx-auto">
        <div class="flex flex-col gap-4">
            <a href="/" class="flex items-center gap-2 shrink-0 w-fit">
                <img src="{{ asset('images/logo_halsea.png') }}" alt="Halsea Logo" class="h-12 w-auto">
                <div class="flex flex-col -space-y-1 text-center mt-1">
                    <span class="text-2xl font-bold tracking-[0.3em] text-[#1e3a5f] uppercase ml-2">Halsea</span>
                    <span class="text-xs font-bold tracking-[0.15em] text-[#3eb4c1] uppercase">Halmahera Selatan</span>
                </div>
            </a>
            <p class="text-on-surface-variant text-sm">{{ __('Explore the Land of Kings. Discover the hidden gems of South Halmahera.') }}</p>
        </div>
        <div>
            <h4 class="font-headline-md text-headline-md font-bold text-primary mb-6">{{ __('Explore') }}</h4>
            <ul class="space-y-3">
                <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('About Us') }}</a></li>
                <li><a href="/destinations" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('Destinations') }}</a></li>
                <li><a href="/events" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('Events') }}</a></li>
                <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('FAQ') }}</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-headline-md text-headline-md font-bold text-primary mb-6">{{ __('Legal') }}</h4>
            <ul class="space-y-3">
                <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('Privacy Policy') }}</a></li>
                <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('Terms of Service') }}</a></li>
                <li><a href="#" class="text-on-surface-variant hover:text-primary transition-colors text-sm">{{ __('Contact Support') }}</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-headline-md text-headline-md font-bold text-primary mb-6">{{ __('Newsletter') }}</h4>
            <p class="text-on-surface-variant text-sm mb-4">{{ __('Stay updated with the latest travel packages and events.') }}</p>
            <div class="flex gap-2">
                <input type="email" placeholder="{{ __('Your email') }}" class="bg-surface border border-outline-variant rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-primary/20 outline-none text-sm">
                <button class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:bg-primary/90 transition-all text-sm">{{ __('Join') }}</button>
            </div>
        </div>
    </div>
    <div class="border-t border-outline-variant py-8 text-center">
        <p class="text-on-surface-variant text-sm">&copy; {{ date('Y') }} HALSEA (Halmahera Selatan). All Rights Reserved. Explore the Land of Kings.</p>
    </div>
</footer>
