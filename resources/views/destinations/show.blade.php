<x-public-layout>
    <main class="pt-24 pb-20 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-sm text-label-sm">
            <a class="hover:text-primary transition-colors" href="{{ url('/') }}">{{ __('Home') }}</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('destinations.index') }}">{{ __('Destinations') }}</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary font-semibold">{{ $destination->name }}</span>
        </nav>

        <!-- Gallery Section -->
        @php
            $mediaItems = $destination->getMedia('default');
            $mainImage = $mediaItems->count() > 0 ? $mediaItems[0]->getUrl() : ($destination->image_url ?? 'https://via.placeholder.com/1200x800');
            $secondImage = $mediaItems->count() > 1 ? $mediaItems[1]->getUrl() : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            $thirdImage = $mediaItems->count() > 2 ? $mediaItems[2]->getUrl() : 'https://images.unsplash.com/photo-1582967633215-6677943cc97f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            
            $allImages = $mediaItems->map(fn($media) => $media->getUrl())->toArray();
            if (empty($allImages)) {
                $allImages = [$mainImage, $secondImage, $thirdImage];
            }
        @endphp
        <section x-data="{ galleryOpen: false, currentImageIndex: 0, images: {{ json_encode($allImages) }} }" class="mb-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-8 rounded-3xl overflow-hidden shadow-soft h-[500px] cursor-pointer group" @click="galleryOpen = true; currentImageIndex = 0">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                         src="{{ $mainImage }}" 
                         alt="{{ $destination->name }} - Main Image"/>
                </div>
                <div class="md:col-span-4 grid grid-cols-2 md:grid-cols-1 gap-4">
                    <div class="rounded-2xl overflow-hidden shadow-soft h-[242px] cursor-pointer group" @click="galleryOpen = true; currentImageIndex = Math.min(1, images.length - 1)">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             src="{{ $secondImage }}" 
                             alt="{{ $destination->name }} - Gallery Image 1"/>
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-soft relative h-[242px] cursor-pointer group" @click="galleryOpen = true; currentImageIndex = Math.min(2, images.length - 1)">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                             src="{{ $thirdImage }}" 
                             alt="{{ $destination->name }} - Gallery Image 2"/>
                        <button class="absolute inset-0 bg-black/40 flex items-center justify-center text-white font-label-md text-label-md hover:bg-black/50 transition-colors">
                            <span class="material-symbols-outlined mr-2">grid_view</span> {{ __('View All Photos') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Fullscreen Lightbox Modal -->
            <template x-teleport="body">
                <div x-show="galleryOpen" style="display: none;"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-[100] bg-black/95 flex flex-col backdrop-blur-xl"
                     @keydown.escape.window="galleryOpen = false"
                     @keydown.right.window="currentImageIndex = (currentImageIndex + 1) % images.length"
                     @keydown.left.window="currentImageIndex = (currentImageIndex - 1 + images.length) % images.length">
                     
                     <!-- Top Bar -->
                     <div class="flex justify-between items-center p-6 text-white absolute top-0 w-full z-10 bg-gradient-to-b from-black/50 to-transparent">
                         <div class="font-label-md text-label-md bg-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                             <span x-text="currentImageIndex + 1"></span> / <span x-text="images.length"></span>
                         </div>
                         <button @click="galleryOpen = false" class="p-3 hover:bg-white/10 rounded-full transition-colors flex items-center justify-center bg-white/5 backdrop-blur-md">
                             <span class="material-symbols-outlined text-[24px]">close</span>
                         </button>
                     </div>
                     
                     <!-- Main Image Viewer -->
                     <div class="flex-1 flex items-center justify-center p-4 md:p-12 relative overflow-hidden">
                         <button @click.stop="currentImageIndex = (currentImageIndex - 1 + images.length) % images.length" class="absolute left-4 md:left-12 p-4 bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors flex items-center justify-center border border-white/20 backdrop-blur-md z-10 shadow-lg">
                             <span class="material-symbols-outlined">chevron_left</span>
                         </button>
                         
                         <!-- Image Container with Transition -->
                         <div class="w-full h-full flex items-center justify-center" x-ref="imageContainer">
                             <template x-for="(img, index) in images" :key="index">
                                 <img x-show="currentImageIndex === index"
                                      x-transition:enter="transition ease-out duration-300 transform"
                                      x-transition:enter-start="opacity-0 scale-95"
                                      x-transition:enter-end="opacity-100 scale-100"
                                      :src="img" 
                                      class="max-w-full max-h-full object-contain drop-shadow-2xl absolute" 
                                      alt="Gallery View"/>
                             </template>
                         </div>
                         
                         <button @click.stop="currentImageIndex = (currentImageIndex + 1) % images.length" class="absolute right-4 md:right-12 p-4 bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors flex items-center justify-center border border-white/20 backdrop-blur-md z-10 shadow-lg">
                             <span class="material-symbols-outlined">chevron_right</span>
                         </button>
                     </div>
                     
                     <!-- Thumbnail Navigation -->
                     <div class="h-28 md:h-36 bg-gradient-to-t from-black/80 to-transparent flex items-center justify-center px-4 md:px-12 w-full pb-6 pt-10">
                         <div class="flex items-center gap-3 overflow-x-auto hide-scrollbar max-w-4xl mx-auto px-4" style="scrollbar-width: none; -ms-overflow-style: none;">
                             <template x-for="(img, index) in images" :key="index">
                                 <button @click="currentImageIndex = index" 
                                         class="h-16 md:h-20 shrink-0 aspect-video rounded-lg overflow-hidden border-2 transition-all duration-300 shadow-lg"
                                         :class="currentImageIndex === index ? 'border-primary scale-110 opacity-100 ring-4 ring-primary/30 z-10' : 'border-transparent opacity-40 hover:opacity-100 hover:scale-105'">
                                     <img :src="img" class="w-full h-full object-cover"/>
                                 </button>
                             </template>
                         </div>
                     </div>
                </div>
            </template>
        </section>

        <!-- Content Layout -->
        <div class="flex flex-col lg:flex-row gap-gutter">
            <!-- Information Side -->
            <div class="lg:w-2/3 space-y-12">
                <!-- Main Header Info -->
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="px-3 py-1 rounded-full bg-secondary/10 text-secondary font-label-md text-label-md">{{ $destination->category }}</span>
                        <div class="flex items-center text-primary font-label-md text-label-md">
                            <span class="material-symbols-outlined fill text-primary mr-1" style="font-variation-settings: 'FILL' 1;">star</span>
                            {{ number_format($destination->rating ?? 5.0, 1) }} ({{ $destination->review_count ?? rand(50, 300) }} {{ __('Reviews') }})
                        </div>
                    </div>
                    
                    <h1 class="font-headline-xl text-headline-xl text-on-surface">{{ $destination->name }}</h1>
                    
                    <div class="flex items-center text-on-surface-variant font-body-md text-body-md">
                        <span class="material-symbols-outlined mr-1">location_on</span>
                        {{ $destination->location }}
                    </div>
                </div>

                <hr class="border-outline-variant"/>

                <!-- Description -->
                <section class="space-y-4">
                    <h2 class="font-headline-md text-headline-md">{{ __('About this destination') }}</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed whitespace-pre-line">
                        {{ $destination->description }}
                    </p>
                </section>

                @if(!empty($destination->facilities))
                <!-- Facilities -->
                <section class="space-y-6">
                    <h2 class="font-headline-md text-headline-md">{{ __('What this place offers') }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
                        @php
                            $facilityIcons = [
                                'Swimming Area' => 'waves',
                                'Snorkeling' => 'scuba_diving',
                                'Private Cabanas' => 'deck',
                                'Local Culinary' => 'restaurant',
                                'Restrooms' => 'wc',
                                'Secure Parking' => 'local_parking',
                                'Photo Spots' => 'photo_camera',
                                'Camping Ground' => 'camping',
                                'WIFI' => 'wifi'
                            ];
                        @endphp
                        @foreach($destination->facilities as $facility)
                        <div class="flex items-center gap-3 text-on-surface">
                            <span class="material-symbols-outlined text-secondary">{{ $facilityIcons[$facility] ?? 'check_circle' }}</span>
                            <span class="font-body-md text-body-md">{{ __($facility) }}</span>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Opening Hours (Static Placeholder) -->
                <section class="bg-surface-container-low p-8 rounded-2xl border border-outline-variant">
                    <h3 class="font-headline-md text-headline-md mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">schedule</span>
                        {{ __('Opening Hours') }}
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between font-body-md text-body-md">
                            <span>{{ __('Monday - Friday') }}</span>
                            <span class="font-semibold">08:00 - 18:00</span>
                        </div>
                        <div class="flex justify-between font-body-md text-body-md">
                            <span>{{ __('Saturday - Sunday') }}</span>
                            <span class="font-semibold">07:00 - 20:00</span>
                        </div>
                    </div>
                </section>

                <!-- Interactive Map Preview -->
                <section class="space-y-4">
                    <div class="flex justify-between items-end">
                        <h2 class="font-headline-md text-headline-md">{{ __('Location') }}</h2>
                        <a href="/map?dest={{ $destination->id }}" class="text-primary font-label-md text-label-md hover:underline">{{ __('Get Directions') }}</a>
                    </div>
                    
                    <!-- Leaflet Assets -->
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
                    
                    <div class="w-full h-[300px] rounded-3xl overflow-hidden relative shadow-soft border border-outline-variant/50" z-index="0"
                         x-data="destinationDetailMap()" 
                         x-init="initMap()">
                        <div id="destination-map" class="w-full h-full z-10"></div>
                        
                        <div class="absolute bottom-4 left-4 right-4 bg-white/70 backdrop-blur-xl p-4 rounded-2xl flex items-center justify-between border border-white/30 z-[1000] pointer-events-none">
                            <div class="text-on-surface">
                                <h5 class="font-label-md text-label-md">{{ $destination->location }}</h5>
                                <p class="text-label-sm font-label-sm text-on-surface-variant">{{ __('Halmahera Selatan, North Maluku') }}</p>
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}" target="_blank" class="bg-white text-primary p-2 rounded-xl shadow-sm hover:scale-110 transition-transform pointer-events-auto">
                                <span class="material-symbols-outlined">directions</span>
                            </a>
                        </div>
                    </div>
                    
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('destinationDetailMap', () => ({
                                map: null,
                                lat: {{ $destination->latitude ?? -0.6409 }},
                                lng: {{ $destination->longitude ?? 127.8879 }},
                                
                                initMap() {
                                    // Give it a tiny delay to ensure the DOM is fully ready and dimensions are calculated
                                    setTimeout(() => {
                                        this.map = L.map('destination-map', {
                                            scrollWheelZoom: false // Prevent accidental scrolling while reading
                                        }).setView([this.lat, this.lng], 12);

                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            maxZoom: 19,
                                            attribution: '© OpenStreetMap contributors'
                                        }).addTo(this.map);

                                        // Custom marker matching the design vibe
                                        const customIcon = L.divIcon({
                                            className: 'custom-div-icon',
                                            html: `<div style="background-color: #964900; color: white; padding: 8px; border-radius: 50%; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border: 4px solid rgba(255, 255, 255, 0.5); display: flex; align-items: center; justify-content: center;"><span class="material-symbols-outlined" style="font-size: 20px;">location_on</span></div>`,
                                            iconSize: [40, 40],
                                            iconAnchor: [20, 20]
                                        });

                                        L.marker([this.lat, this.lng], { icon: customIcon }).addTo(this.map)
                                            .bindPopup("<b>{{ $destination->name }}</b><br/>{{ $destination->location }}");
                                            
                                        // Fix for hidden or zero-size container issue in some frameworks
                                        this.map.invalidateSize();
                                    }, 100);
                                }
                            }));
                        });
                    </script>
                </section>
            </div>

            <!-- Sticky Booking Card -->
            <aside class="lg:w-1/3">
                <div class="sticky top-28 bg-surface-container-lowest border border-outline-variant p-6 md:p-8 rounded-3xl shadow-soft space-y-6">
                    <div class="flex justify-between items-baseline">
                        <div>
                            @if($destination->price > 0)
                                <span class="font-headline-md text-headline-md text-primary">IDR {{ number_format($destination->price, 0, ',', '.') }}</span>
                                <span class="text-on-surface-variant font-label-md text-label-md">/ {{ __('person') }}</span>
                            @else
                                <span class="font-headline-md text-headline-md text-primary">{{ __('Free Entry') }}</span>
                            @endif
                        </div>
                    </div>

                    @if($destination->price > 0)
                    <div class="space-y-4" x-data="{ visitors: 1, price: {{ $destination->price }} }">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant">{{ __('Visit Date') }}</label>
                            <div class="flex items-center gap-3 p-4 bg-surface rounded-xl border border-outline-variant focus-within:border-primary transition-colors">
                                <span class="material-symbols-outlined text-on-surface-variant">calendar_today</span>
                                <input class="bg-transparent border-none p-0 focus:ring-0 w-full font-body-md text-body-md outline-none" type="date" value="{{ date('Y-m-d') }}"/>
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
                        <a href="/map?dest={{ $destination->id }}" class="w-full text-center py-4 rounded-xl bg-primary text-white font-label-md text-label-md hover:brightness-110 transition-all shadow-md active:scale-95">{{ __('View Directions') }}</a>
                    </div>
                    @endif
                    <p class="text-center font-label-sm text-label-sm text-on-surface-variant">{{ __('Free cancellation up to 24 hours before.') }}</p>
                </div>
            </aside>
        </div>

        <!-- Nearby Attractions -->
        @php
            $nearby = \App\Models\Destination::where('id', '!=', $destination->id)->inRandomOrder()->limit(4)->get();
        @endphp
        
        @if($nearby->count() > 0)
        <section class="mt-24 space-y-8">
            <div class="flex justify-between items-end">
                <div class="space-y-2">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ __('Explore Nearby') }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">{{ __('Discover more treasures around') }} {{ $destination->name }}.</p>
                </div>
                <a href="{{ route('destinations.index') }}" class="hidden md:flex items-center gap-2 text-primary font-label-md text-label-md hover:underline group">
                    {{ __('View All') }} <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
                @foreach($nearby as $item)
                <a href="{{ route('destinations.show', $item->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-soft hover:shadow-xl transition-all duration-300 block">
                    <div class="h-48 overflow-hidden relative">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             src="{{ $item->image_url ?? 'https://via.placeholder.com/600x400' }}" 
                             alt="{{ $item->name }}"/>
                        <div class="absolute top-3 right-3 bg-white/95 px-2 py-0.5 rounded-full text-xs font-semibold flex items-center gap-1 shadow-sm">
                            <span class="material-symbols-outlined text-[14px] text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-on-surface">{{ number_format($item->rating ?? 5.0, 1) }}</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-2">
                        <div class="text-secondary font-label-sm text-label-sm uppercase tracking-wider">{{ $item->category }}</div>
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

        <!-- Reviews Placeholder -->
        <section class="mt-24 space-y-12 mb-12">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ __('Traveler Reviews') }}</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">{{ __('Hear from those who have stepped onto these sands.') }}</p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <div class="font-headline-xl text-[40px] text-primary leading-tight">{{ number_format($destination->rating ?? 5.0, 1) }}</div>
                        <div class="text-on-surface-variant font-label-sm text-label-sm uppercase">{{ __('Global Rating') }}</div>
                    </div>
                    <button class="bg-primary text-white px-8 py-3 rounded-xl font-label-md text-label-md hover:brightness-110 transition-all shadow-md">{{ __('Write a Review') }}</button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                <div class="p-8 bg-surface-container-low rounded-2xl border border-outline-variant space-y-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center font-bold text-on-tertiary-fixed">JS</div>
                            <div>
                                <h4 class="font-label-md text-label-md text-on-surface">James Stewart</h4>
                                <p class="font-label-sm text-label-sm text-on-surface-variant">{{ __('Visited recently') }}</p>
                            </div>
                        </div>
                        <div class="flex text-primary">
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                    </div>
                    <p class="font-body-md text-body-md text-on-surface-variant italic">
                        "An absolute paradise. The water is so clear it's like swimming in a giant pool. Highly recommend visiting this spot!"
                    </p>
                </div>
                
                <div class="p-8 bg-surface-container-low rounded-2xl border border-outline-variant space-y-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-secondary-fixed flex items-center justify-center font-bold text-on-secondary-fixed">AN</div>
                            <div>
                                <h4 class="font-label-md text-label-md text-on-surface">Anisa Nurul</h4>
                                <p class="font-label-sm text-label-sm text-on-surface-variant">{{ __('Visited last month') }}</p>
                            </div>
                        </div>
                        <div class="flex text-primary">
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                    </div>
                    <p class="font-body-md text-body-md text-on-surface-variant italic">
                        "Tempat yang luar biasa tenang. Cocok untuk healing dari keramaian kota. Will definitely come back with my whole family next year!"
                    </p>
                </div>
            </div>
        </section>
    </main>
</x-public-layout>

<!-- Leaflet CSS & JS for Interactive Map -->
@if($destination->latitude && $destination->longitude)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('destinationMap', {
            zoomControl: false,
            scrollWheelZoom: false
        }).setView([{{ $destination->latitude }}, {{ $destination->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        var destIcon = L.divIcon({
            html: `
                <div style="display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; background-color: #006b54; border: 2.5px solid #ffffff; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.25); color: #ffffff;">
                    <span class="material-symbols-outlined" style="font-size: 18px; display: block;">explore</span>
                </div>
            `,
            className: 'custom-dest-marker',
            iconSize: [34, 34],
            iconAnchor: [17, 34],
        });

        L.marker([{{ $destination->latitude }}, {{ $destination->longitude }}], {icon: destIcon}).addTo(map);
    });
</script>
<style>
    .leaflet-pane { z-index: 10; }
    .leaflet-top, .leaflet-bottom { z-index: 10; }
</style>
@endif
