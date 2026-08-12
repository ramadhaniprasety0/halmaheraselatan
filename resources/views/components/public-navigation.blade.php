<nav x-data="{ mobileMenuOpen: false, searchOpen: false }" class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-xl shadow-sm glass-effect">
    <div class="flex justify-between gap-2 items-center w-full px-margin-mobile md:px-margin-desktop py-4 max-w-container-max mx-auto">
        
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 shrink-0">
            <img src="{{ asset('images/logo_halsea.png') }}" alt="Halsea Logo" class="h-12 w-auto">
            <div class="flex flex-col -space-y-1 text-center mt-1">
                <span class="text-2xl font-bold tracking-[0.3em] text-[#1e3a5f] uppercase ml-2">Halsea</span>
                <span class="text-xs font-bold tracking-[0.15em] text-[#3eb4c1] uppercase">Halmahera Selatan</span>
            </div>
        </a>
        
        <!-- Desktop Links & Search Container -->
        <div class="hidden xl:flex flex-1 items-center relative mx-8 xl:mx-12">
            <!-- Desktop Links -->
            <div :class="{'opacity-0 pointer-events-none scale-95': searchOpen, 'opacity-100 scale-100': !searchOpen}" class="flex items-center gap-6 xl:gap-8 transition-all duration-300 origin-left">
                <a href="/" class="{{ request()->is('/') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-label-md text-label-md whitespace-nowrap">
                    {{ __('Home') }}
                </a>
                <a href="/destinations" class="{{ request()->is('destinations*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-label-md text-label-md whitespace-nowrap">
                    {{ __('Destinations') }}
                </a>
                <a href="/events" class="{{ request()->is('events*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-label-md text-label-md whitespace-nowrap">
                    {{ __('Events') }}
                </a>
                <a href="/accommodations" class="{{ request()->is('accommodations*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-label-md text-label-md whitespace-nowrap">
                    {{ __('Accommodations') }}
                </a>
                <a href="/culinary" class="{{ request()->is('culinary*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-label-md text-label-md whitespace-nowrap">
                    {{ __('Culinary') }}
                </a>
                <a href="/map" class="{{ request()->is('map*') ? 'text-primary font-bold border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }} font-label-md text-label-md whitespace-nowrap">
                    {{ __('Interactive Map') }}
                </a>
            </div>
            
            <!-- Search Input -->
            <div :class="{'opacity-0 pointer-events-none scale-95': !searchOpen, 'opacity-100 scale-100': searchOpen}" class="absolute left-0 w-full max-w-xl transition-all duration-300 origin-left flex items-center opacity-0 pointer-events-none scale-95 z-10">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                    <input type="text" x-ref="searchInput" placeholder="{{ __('Search destinations, events, culinary...') }}" class="w-full bg-surface text-on-surface border border-outline-variant rounded-full py-2.5 pl-11 pr-4 focus:ring-2 focus:ring-primary focus:border-primary outline-none shadow-sm transition-all font-body-md" @keydown.escape="searchOpen = false">
                </div>
            </div>
        </div>
        
        <!-- Trailing Actions -->
        <div class="hidden lg:flex items-center gap-4 shrink-0">
            
            <!-- Search Button -->
            <button @click="searchOpen = !searchOpen; if(searchOpen) $nextTick(() => $refs.searchInput.focus())" class="p-2 hover:bg-primary/5 rounded-full transition-all flex items-center justify-center">
                <span class="material-symbols-outlined text-primary" x-text="searchOpen ? 'close' : 'search'">search</span>
            </button>
            
            @auth
                <a href="{{ route('dashboard') }}" class="bg-primary-container text-on-primary font-bold px-6 py-2 rounded-xl shadow-md hover:scale-105 active:scale-95 transition-all whitespace-nowrap">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-primary-container text-on-primary font-bold px-6 py-2 rounded-xl shadow-md hover:scale-105 active:scale-95 transition-all whitespace-nowrap">
                    {{ __('Sign In') }}
                </a>
                <!-- <a href="{{ route('register') }}" class="bg-primary-container text-on-primary font-bold px-6 py-2 rounded-xl shadow-md hover:scale-105 active:scale-95 transition-all whitespace-nowrap">
                    {{ __('Register') }}
                </a> -->
            @endauth

            <!-- Language Switcher Dropdown (Custom Proxy) -->
            <div class="relative ml-2 flex items-center gap-1">
                <span class="material-symbols-outlined text-primary text-[20px]" translate="no">language</span>
                <select id="custom_lang_selector" class="bg-transparent border-none text-primary font-bold text-[14px] cursor-pointer outline-none appearance-none pr-4 min-w-max" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23964900%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right center; background-size: 10px;" translate="no">
                    <option value="" class="text-gray-800">ID</option>
                    <option value="en" class="text-gray-800">EN</option>
                    <option value="nl" class="text-gray-800">NL</option>
                    <option value="ja" class="text-gray-800">JA</option>
                    <option value="zh-CN" class="text-gray-800">ZH</option>
                </select>
                <div id="google_translate_element" class="hidden"></div>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="lg:hidden flex items-center">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-primary hover:bg-primary/10 rounded-lg">
                <span class="material-symbols-outlined text-2xl" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" style="display: none;" class="lg:hidden absolute top-full left-0 w-full bg-surface border-b border-outline-variant shadow-lg z-40">
        <div class="flex flex-col px-4 py-4 gap-2">
            
            <!-- Mobile Search -->
            <div class="relative w-full mb-2">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input type="text" placeholder="{{ __('Search destinations, events...') }}" class="w-full bg-surface text-on-surface border border-outline-variant rounded-full py-2 pl-11 pr-4 focus:ring-2 focus:ring-primary focus:border-primary outline-none shadow-sm transition-all font-body-md">
            </div>

            <a href="/" class="block px-4 py-3 rounded-lg {{ request()->is('/') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container' }}">
                {{ __('Home') }}
            </a>
            <a href="/destinations" class="block px-4 py-3 rounded-lg {{ request()->is('destinations*') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container' }}">
                {{ __('Destinations') }}
            </a>
            <a href="/events" class="block px-4 py-3 rounded-lg {{ request()->is('events*') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container' }}">
                {{ __('Events') }}
            </a>
            <a href="/map" class="block px-4 py-3 rounded-lg {{ request()->is('map*') ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container' }}">
                {{ __('Interactive Map') }}
            </a>
            <hr class="my-2 border-outline-variant">
            <div class="flex justify-center px-4 py-2" id="mobile_google_translate_element">
                <span class="text-xs text-on-surface-variant text-center">{{ __('Use the translator icon at the top to change language.') }}</span>
            </div>
            <hr class="my-2 border-outline-variant">
            @auth
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 bg-primary-container text-on-primary text-center font-bold rounded-lg shadow-md">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-3 text-center font-bold text-primary rounded-lg border border-primary">
                    {{ __('Sign In') }}
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-3 bg-primary-container text-on-primary text-center font-bold rounded-lg shadow-md">
                    {{ __('Register') }}
                </a>
            @endauth
        </div>
    </div>
</nav>
