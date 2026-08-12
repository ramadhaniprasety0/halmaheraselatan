<x-public-layout>
    <main class="pt-24 pb-20 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-sm text-label-sm">
            <a class="hover:text-primary transition-colors" href="{{ url('/') }}">{{ __('Home') }}</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('events.index') }}">{{ __('Events') }}</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary font-semibold">{{ $event->name }}</span>
        </nav>

        <!-- Hero Banner -->
        <section class="mb-12">
            <div class="relative h-[400px] md:h-[600px] w-full rounded-3xl overflow-hidden shadow-soft">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $event->hasMedia('default') ? $event->image_url : 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?q=80&w=1200&auto=format&fit=crop' }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-10 left-10 right-10 text-white">
                    <div class="flex gap-2 mb-4">
                        <span class="bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-label-sm font-label-sm">{{ __('Cultural Heritage') }}</span>
                    </div>
                    <h1 class="font-headline-xl text-headline-xl mb-2">{{ $event->name }}</h1>
                    <p class="font-body-lg text-body-lg opacity-90 max-w-2xl line-clamp-2">{{ $event->description }}</p>
                </div>
            </div>
        </section>

        <!-- Content Layout -->
        <div class="flex flex-col lg:flex-row gap-gutter">
            <!-- Left Column: Main Info -->
            <div class="lg:w-2/3 space-y-12">
                <!-- Event Info -->
                <section class="space-y-6" id="about">
                    <h2 class="font-headline-md text-headline-md">{{ __('Experience the Land of Kings') }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-surface-container-low p-4 rounded-2xl flex flex-col items-center text-center">
                            <span class="material-symbols-outlined text-secondary mb-2">calendar_today</span>
                            <span class="font-label-md text-label-md">{{ \Carbon\Carbon::parse($event->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d, Y') }}</span>
                        </div>
                        <div class="bg-surface-container-low p-4 rounded-2xl flex flex-col items-center text-center">
                            <span class="material-symbols-outlined text-secondary mb-2">location_on</span>
                            <span class="font-label-md text-label-md">{{ $event->location }}</span>
                        </div>
                        <div class="bg-surface-container-low p-4 rounded-2xl flex flex-col items-center text-center">
                            <span class="material-symbols-outlined text-secondary mb-2">group</span>
                            <span class="font-label-md text-label-md">{{ $event->audience ?: __('Open to Public') }}</span>
                        </div>
                        <div class="bg-surface-container-low p-4 rounded-2xl flex flex-col items-center text-center">
                            <span class="material-symbols-outlined text-secondary mb-2">history_edu</span>
                            <span class="font-label-md text-label-md">{{ $event->event_type ?: __('Annual Tradition') }}</span>
                        </div>
                    </div>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed whitespace-pre-line">
                        {{ $event->description }}
                    </p>
                </section>

                <!-- Agenda -->
                @if($event->schedule && is_array($event->schedule) && count($event->schedule) > 0)
                <section class="space-y-6" id="agenda">
                    <h2 class="font-headline-sm text-headline-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">event_note</span>
                        {{ __('Event Agenda') }}
                    </h2>
                    <div class="space-y-4">
                        @foreach($event->schedule as $index => $day)
                        <div class="group border border-outline-variant rounded-2xl overflow-hidden hover:border-primary transition-all bg-surface-container-lowest">
                            <button class="w-full flex items-center justify-between p-6 text-left" onclick="this.nextElementSibling.classList.toggle('hidden')">
                                <div>
                                    <span class="text-secondary font-label-md text-label-sm uppercase tracking-wider">{{ __($day['day'] ?? '') }}</span>
                                    <h4 class="font-headline-md text-headline-sm font-bold">{{ __($day['title'] ?? '') }}</h4>
                                </div>
                                <span class="material-symbols-outlined transition-transform group-hover:translate-y-1">expand_more</span>
                            </button>
                            <div class="{{ $index === 0 ? '' : 'hidden ' }}px-6 pb-6 pt-2 border-t border-outline-variant/50">
                                <div class="space-y-4">
                                    @if(isset($day['items']) && is_array($day['items']))
                                        @foreach($day['items'] as $item)
                                        <div class="flex gap-4">
                                            @if(!empty($item['time']))
                                            <span class="font-bold text-primary font-body-md whitespace-nowrap">{{ $item['time'] }}</span>
                                            @else
                                            <span class="material-symbols-outlined text-primary">schedule</span>
                                            @endif
                                            <p class="font-body-md text-body-md">{{ __($item['description'] ?? '') }}</p>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Organizer -->
                <section class="bg-surface-container p-4 rounded-3xl flex flex-col md:flex-row items-center gap-8 shadow-soft" id="organizer">
                    <img class="w-16 h-16 border border-outline rounded-full object-cover shadow-md" src="{{ asset('images/logo_halsea.png') }}"/>
                    <div class="flex-1 text-center md:text-left">
                        <span class="text-label-sm font-label-sm text-secondary uppercase tracking-widest mb-1 block">{{ __('Hosted By') }}</span>
                        <h4 class="font-headline-sm text-headline-sm mb-2 font-bold">Halsea Tourism & Culture Board</h4>
                        <p class="text-on-surface-variant font-body-md text-body-md mb-4">{{ __('Dedicated to preserving and promoting the unique heritage of Halmahera Selatan for the global stage.') }}</p>
                        <div class="flex justify-center md:justify-start gap-4">
                            <button class="text-primary hover:underline font-label-md text-label-md flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">verified</span> {{ __('Official Page') }}
                            </button>
                            <button class="text-primary hover:underline font-label-md text-label-md flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">mail</span> {{ __('Contact Host') }}
                            </button>
                        </div>
                    </div>
                </section>

                <!-- Location Map Placeholder -->
                <section class="space-y-6" id="location">
                    <h2 class="font-headline-md text-headline-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">map</span>
                        {{ __('Event Location') }}
                    </h2>
                    @if($event->latitude && $event->longitude)
                    <div class="h-80 rounded-3xl overflow-hidden shadow-soft bg-surface-dim relative border border-outline-variant z-0">
                        <div id="eventMap" class="w-full h-full"></div>
                        <div class="absolute bottom-4 left-4 right-4 bg-white/70 backdrop-blur-xl p-4 rounded-2xl flex items-center justify-between border border-white/30 z-[1000] pointer-events-none">
                            <div>
                                <h5 class="font-label-md text-label-md">{{ $event->location }}</h5>
                                <p class="text-label-sm font-label-sm text-on-surface-variant">{{ __('Halmahera Selatan, North Maluku') }}</p>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $event->latitude }},{{ $event->longitude }}" target="_blank" class="bg-white text-primary p-2 rounded-xl shadow-sm hover:scale-110 transition-transform pointer-events-auto">
                                <span class="material-symbols-outlined">directions</span>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="h-80 rounded-3xl overflow-hidden shadow-soft bg-surface-dim relative border border-outline-variant">
                        <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=800&auto=format&fit=crop')"></div>
                        <div class="absolute bottom-4 left-4 right-4 bg-white/70 backdrop-blur-xl p-4 rounded-2xl flex items-center justify-between border border-white/30">
                            <div>
                                <h5 class="font-label-md text-label-md">{{ $event->location }}</h5>
                                <p class="text-label-sm font-label-sm text-on-surface-variant">{{ __('Halmahera Selatan, North Maluku') }}</p>
                            </div>
                            <button class="bg-white text-primary p-2 rounded-xl shadow-sm hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined">directions</span>
                            </button>
                        </div>
                    </div>
                    @endif
                </section>

                <!-- Reviews -->
                <section class="space-y-6" id="reviews">
                    <div class="flex items-center justify-between">
                        <h2 class="font-headline-md text-headline-md">{{ __('Attendee Reviews') }}</h2>
                        <div class="flex items-center gap-2">
                            <div class="flex text-primary-container">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">star_half</span>
                            </div>
                            <span class="font-bold text-headline-md">4.8</span>
                            <span class="text-on-surface-variant text-label-sm">(120 {{ __('Reviews') }})</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Review 1 -->
                        <div class="bg-white p-6 rounded-3xl shadow-soft border border-outline-variant/50">
                            <div class="flex gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold">JD</div>
                                <div>
                                    <h6 class="font-label-md text-label-md">Julian D.</h6>
                                    <p class="text-label-sm text-on-surface-variant">Attended in 2023</p>
                                </div>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant italic">"The most authentic cultural experience I've had in Indonesia. The Kora-Kora race is breathtaking!"</p>
                        </div>
                        <!-- Review 2 -->
                        <div class="bg-white p-6 rounded-3xl shadow-soft border border-outline-variant/50">
                            <div class="flex gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed font-bold">SM</div>
                                <div>
                                    <h6 class="font-label-md text-label-md">Sarah M.</h6>
                                    <p class="text-label-sm text-on-surface-variant">Attended in 2023</p>
                                </div>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant italic">"A food lover's paradise. The aromatic spice markets are like stepping back in time. Highly recommended."</p>
                        </div>
                    </div>
                    <button class="w-full py-4 border-2 border-primary text-primary font-bold rounded-2xl hover:bg-primary/5 transition-colors">{{ __('See All Reviews') }}</button>
                </section>
            </div>

            <!-- Right Column: Sticky Sidebar -->
            <aside class="lg:w-1/3">
                <div class="sticky top-28 space-y-6">
                    <!-- Sticky Booking Card -->
                    <div class="bg-surface-container-lowest border border-outline-variant p-6 md:p-8 rounded-3xl shadow-soft space-y-6">
                        <div class="flex justify-between items-baseline">
                            <div>
                                @if(($event->price ?? 0) > 0)
                                    <span class="font-headline-md text-headline-md text-primary">IDR {{ number_format($event->price, 0, ',', '.') }}</span>
                                    <span class="text-on-surface-variant font-label-md text-label-md">/ {{ __('person') }}</span>
                                @else
                                    <span class="font-headline-md text-headline-md text-primary">{{ __('Free Entry') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        @if(($event->price ?? 0) > 0)
                        <div class="space-y-4" x-data="{ visitors: 1, price: {{ $event->price }} }">
                            <div class="space-y-2">
                                <label class="font-label-md text-label-md text-on-surface-variant">{{ __('Visit Date') }}</label>
                                <div class="flex items-center gap-3 p-4 bg-surface rounded-xl border border-outline-variant focus-within:border-primary transition-colors">
                                    <span class="material-symbols-outlined text-on-surface-variant">calendar_today</span>
                                    @php
                                        $startDate = \Carbon\Carbon::parse($event->start_date)->format('Y-m-d');
                                        $endDate = \Carbon\Carbon::parse($event->end_date)->format('Y-m-d');
                                        $isSingleDay = $startDate === $endDate;
                                    @endphp
                                    <input class="bg-transparent border-none p-0 focus:ring-0 w-full font-body-md text-body-md outline-none {{ $isSingleDay ? 'cursor-not-allowed opacity-80' : '' }}" 
                                           type="date" 
                                           value="{{ $startDate }}"
                                           min="{{ $startDate }}"
                                           max="{{ $endDate }}"
                                           {{ $isSingleDay ? 'readonly' : '' }}
                                    />
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="font-label-md text-label-md text-on-surface-variant">{{ __('Total Visitors') }}</label>
                                <div class="flex items-center justify-between p-4 bg-surface rounded-xl border border-outline-variant">
                                    <span class="material-symbols-outlined text-on-surface-variant">group</span>
                                    <div class="flex items-center gap-4">
                                        <button @click="if(visitors > 1) visitors--" class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center hover:bg-surface-container transition-colors">-</button>
                                        <span class="font-body-md text-body-md font-semibold min-w-[20px] text-center" x-text="visitors">1</span>
                                        <button @click="visitors++" class="w-8 h-8 rounded-full border border-outline-variant flex items-center justify-center hover:bg-surface-container transition-colors">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 space-y-3">
                                <div class="flex justify-between font-label-md text-label-md">
                                    <span>{{ __('Subtotal') }}</span>
                                    <span>IDR <span x-text="(visitors * price).toLocaleString('id-ID')"></span></span>
                                </div>
                                <div class="flex justify-between font-label-md text-label-md">
                                    <span>{{ __('Service Fee') }}</span>
                                    <span>IDR 15.000</span>
                                </div>
                                <hr class="border-outline-variant"/>
                                <div class="flex justify-between font-headline-md text-headline-md text-on-surface pt-2">
                                    <span>{{ __('Total') }}</span>
                                    <span>IDR <span x-text="(visitors * price + 15000).toLocaleString('id-ID')"></span></span>
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-3 pt-2">
                                <button class="w-full py-4 rounded-xl bg-primary text-white font-label-md text-label-md hover:brightness-110 transition-all shadow-md active:scale-95">{{ __('Book Now') }}</button>
                                <button class="w-full py-4 rounded-xl border border-primary text-primary font-label-md text-label-md hover:bg-primary/5 transition-all active:scale-95">{{ __('Add to Cart') }}</button>
                            </div>
                        </div>
                        @else
                        <div class="flex flex-col gap-3 pt-2">
                            <button class="w-full py-4 rounded-xl bg-primary text-white font-label-md text-label-md hover:brightness-110 transition-all shadow-md active:scale-95">{{ __('Book Free Ticket') }}</button>
                        </div>
                        @endif
                        <p class="text-center font-label-sm text-label-sm text-on-surface-variant">{{ __('Free cancellation up to 24 hours before.') }}</p>
                    </div>

                    <!-- Small Promo Card -->
                    <div class="relative rounded-3xl overflow-hidden aspect-video group cursor-pointer border border-outline-variant/30 shadow-soft">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=600&auto=format&fit=crop"/>
                        <div class="absolute inset-0 bg-gradient-to-r from-secondary/80 to-transparent flex items-center p-6">
                            <div class="text-white">
                                <h6 class="font-headline-md text-headline-md mb-1 leading-tight">{{ __('Culinary Highlights') }}</h6>
                                <p class="font-label-sm text-label-sm opacity-90">{{ __('Taste authentic spices') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Related Events -->
        @php
            $relatedEvents = \App\Models\Event::where('id', '!=', $event->id)->inRandomOrder()->limit(4)->get();
        @endphp
        
        @if($relatedEvents->count() > 0)
        <section class="mt-24 space-y-8">
            <div class="flex justify-between items-end">
                <div class="space-y-2">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ __('Discover More Events') }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">{{ __('Other wonders awaiting in Halmahera Selatan') }}</p>
                </div>
                <a href="{{ route('events.index') }}" class="hidden md:flex items-center gap-2 text-primary font-label-md text-label-md hover:underline group">
                    {{ __('View All Events') }} <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
                @foreach($relatedEvents as $item)
                <a href="{{ route('events.show', $item->id) }}" class="group bg-white rounded-2xl overflow-hidden shadow-soft hover:shadow-xl transition-all duration-300 block">
                    <div class="h-48 overflow-hidden relative">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             src="{{ $item->hasMedia('default') ? $item->image_url : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600&auto=format&fit=crop' }}" 
                             alt="{{ $item->name }}"/>
                    </div>
                    <div class="p-5 space-y-2">
                        <div class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ \Carbon\Carbon::parse($item->start_date)->format('M d, Y') }}</div>
                        <h3 class="font-headline-md text-[20px] text-on-surface line-clamp-1 group-hover:text-primary transition-colors">{{ $item->name }}</h3>
                        <div class="flex items-center gap-1 text-on-surface-variant font-label-md text-label-md line-clamp-1">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            {{ $item->location }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    <!-- Leaflet CSS & JS for Interactive Map -->
    @if($event->latitude && $event->longitude)
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('eventMap', {
                zoomControl: false,
                scrollWheelZoom: false
            }).setView([{{ $event->latitude }}, {{ $event->longitude }}], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            L.control.zoom({
                position: 'topright'
            }).addTo(map);

            var eventIcon = L.divIcon({
                html: `
                    <div style="display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; background-color: #b91c1c; border: 2.5px solid #ffffff; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.25); color: #ffffff;">
                        <span class="material-symbols-outlined" style="font-size: 18px; display: block;">event</span>
                    </div>
                `,
                className: 'custom-event-marker',
                iconSize: [34, 34],
                iconAnchor: [17, 34],
            });

            L.marker([{{ $event->latitude }}, {{ $event->longitude }}], {icon: eventIcon}).addTo(map);
        });
    </script>
    <style>
        .leaflet-pane { z-index: 10; }
        .leaflet-top, .leaflet-bottom { z-index: 10; }
    </style>
    @endif
</x-public-layout>
