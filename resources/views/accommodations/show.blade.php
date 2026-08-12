<x-public-layout>
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-calendar { font-family: 'Plus Jakarta Sans', sans-serif; border-radius: 16px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); }
        
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
            background: #964900 !important;
            border-color: #964900 !important;
            color: #fff !important;
        }
        
        .flatpickr-day.inRange, .flatpickr-day.prevMonthDay.inRange, .flatpickr-day.nextMonthDay.inRange, .flatpickr-day.today.inRange, .flatpickr-day.prevMonthDay.today.inRange, .flatpickr-day.nextMonthDay.today.inRange {
            background: #ffedd5 !important;
            border-color: #ffedd5 !important;
            color: #964900 !important;
            box-shadow: -5px 0 0 #ffedd5, 5px 0 0 #ffedd5 !important;
            border-radius: 0 !important;
        }

        .flatpickr-day:hover, .flatpickr-day.prevMonthDay:hover, .flatpickr-day.nextMonthDay:hover, .flatpickr-day:focus, .flatpickr-day.prevMonthDay:focus, .flatpickr-day.nextMonthDay:focus {
            background: #ffedd5 !important;
            border-color: #ffedd5 !important;
            color: #964900 !important;
        }

        .flatpickr-day.selected.startRange + .endRange:not(:nth-child(7n+1)), .flatpickr-day.startRange.startRange + .endRange:not(:nth-child(7n+1)), .flatpickr-day.endRange.startRange + .endRange:not(:nth-child(7n+1)) {
            box-shadow: -10px 0 0 #ffedd5 !important;
        }

        .flatpickr-day.today {
            border-color: #964900 !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
    <main class="pt-24 pb-20">
        <!-- Breadcrumb -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-8">
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-md text-label-md">
                <a class="hover:text-primary transition-colors" href="/">{{ __('Home') }}</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="{{ route('accommodations.index') }}">{{ __('Accommodations') }}</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-bold">{{ $accommodation->name }}</span>
            </nav>
        </div>

        <!-- Gallery Section -->
        @php
            $mediaItems = $accommodation->getMedia('default');
            $allImages = $mediaItems->map(fn($media) => $media->getUrl())->toArray();
            if (empty($allImages)) {
                $allImages = ['https://via.placeholder.com/1200x800']; // default
            }
        @endphp
        <section x-data="{ galleryOpen: false, currentImageIndex: 0, images: {{ json_encode($allImages) }} }" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mb-12">
            @if($mediaItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-[400px] md:h-[600px]">
                    <div class="md:col-span-2 md:row-span-2 rounded-xl overflow-hidden relative group cursor-pointer" @click="galleryOpen = true; currentImageIndex = 0">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $mediaItems[0]->getUrl() }}" alt="{{ $accommodation->name }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                    
                    @foreach($mediaItems->skip(1)->take(4) as $index => $media)
                        <div class="hidden md:block rounded-xl overflow-hidden group relative cursor-pointer" @click="galleryOpen = true; currentImageIndex = {{ $index + 1 }}">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $media->getUrl() }}" alt="{{ $accommodation->name }}"/>
                            @if($loop->last)
                                <button class="absolute inset-0 bg-black/40 flex items-center justify-center w-full h-full text-white font-label-md text-label-md hover:bg-black/50 transition-colors">
                                    <span class="material-symbols-outlined mr-2">grid_view</span> {{ __('View All Photos') }}
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full h-[500px] rounded-[32px] bg-surface-container-high flex items-center justify-center border border-outline-variant">
                    <span class="material-symbols-outlined text-6xl text-outline">hotel</span>
                </div>
            @endif

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

        <!-- Main Content Grid -->
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Info Side -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Title and Tags -->
                <div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-secondary/10 text-secondary px-3 py-1 rounded-full font-label-sm text-label-sm">{{ $accommodation->type }}</span>
                        @if($accommodation->is_featured)
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full font-label-sm text-label-sm">Featured</span>
                        @endif
                    </div>
                    <h1 class="font-headline-xl text-headline-xl text-on-surface mb-2">{{ $accommodation->name }}</h1>
                    <div class="flex items-center gap-4 text-on-surface-variant font-label-md">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-bold text-on-surface">{{ $accommodation->rating }}</span>
                            <span>({{ $accommodation->review_count }} Reviews)</span>
                        </div>
                        <span>•</span>
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined">location_on</span>
                            <span>{{ $accommodation->location }}</span>
                        </div>
                    </div>
                </div>
                
                <hr class="border-outline-variant"/>
                
                <!-- Description -->
                <section>
                    <h2 class="font-headline-md text-headline-md mb-4">About this Sanctuary</h2>
                    <p class="text-body-lg font-body-lg text-on-surface-variant leading-relaxed">
                        {{ $accommodation->short_description }}
                    </p>
                    <div class="mt-4 text-body-md font-body-md text-on-surface-variant leading-relaxed whitespace-pre-wrap">{{ $accommodation->description }}</div>
                </section>
                
                <!-- Facilities -->
                <section>
                    <h2 class="font-headline-md text-headline-md mb-6">What this place offers</h2>
                    @if($accommodation->facilities && count($accommodation->facilities) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($accommodation->facilities as $facility)
                                <div class="flex items-center gap-3 text-on-surface">
                                    <span class="material-symbols-outlined text-primary">check_circle</span>
                                    <span class="font-label-md">{{ $facility }}</span>
                                </div>
                            @endforeach
                        </div>
                        <button class="mt-8 px-8 py-3 border border-outline rounded-xl font-label-md hover:bg-surface-container transition-colors">Show all amenities</button>
                    @else
                        <p class="text-on-surface-variant">No amenities listed.</p>
                    @endif
                </section>
                
                <hr class="border-outline-variant"/>
                
                <!-- Policies -->
                <section>
                    <h2 class="font-headline-md text-headline-md mb-6">House Rules & Policies</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-bold text-on-surface mb-3">Check-in / Check-out</h3>
                            <ul class="space-y-2 text-on-surface-variant font-body-md">
                                <li class="flex justify-between"><span>Check-in:</span> <span class="font-medium text-on-surface">After 2:00 PM</span></li>
                                <li class="flex justify-between"><span>Check-out:</span> <span class="font-medium text-on-surface">Before 11:00 AM</span></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold text-on-surface mb-3">Cancellation Policy</h3>
                            <p class="text-on-surface-variant font-body-md">Free cancellation for 48 hours. After that, cancel up to 7 days before check-in and get a 50% refund.</p>
                        </div>
                    </div>
                </section>
                
                <hr class="border-outline-variant"/>
                
                <!-- Room Selection (UI Placeholder from Stitch) -->
                <section class="space-y-8" id="room-selection">
                    <h2 class="font-headline-md text-headline-md">Pilihan Kamar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Room Card 1 -->
                        <div class="bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/30 flex flex-col">
                            <div class="h-48 overflow-hidden">
                                <img alt="Ocean View Suite" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1474&q=80"/>
                            </div>
                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="font-bold text-on-surface text-lg mb-2">Ocean View Suite</h3>
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                        <span class="material-symbols-outlined text-[18px]">king_bed</span>
                                        <span>1 King Bed</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                        <span class="material-symbols-outlined text-[18px]">balcony</span>
                                        <span>Private Balcony</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                        <span class="material-symbols-outlined text-[18px]">ac_unit</span>
                                        <span>Air Conditioning</span>
                                    </div>
                                </div>
                                <div class="mt-auto flex items-center justify-between">
                                    <div>
                                        <span class="font-headline-md text-headline-md text-primary">Rp {{ number_format(1500000, 0, ',', '.') }}</span>
                                        <span class="text-on-surface-variant font-label-md text-label-md">/ night</span>
                                    </div>
                                    <button class="bg-primary text-white px-6 py-2 rounded-full font-label-md text-label-md hover:bg-primary/90 transition-all active:scale-95">Pilih Kamar</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room Card 2 -->
                        <div class="bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/30 flex flex-col">
                            <div class="h-48 overflow-hidden">
                                <img alt="Garden Deluxe Room" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80"/>
                            </div>
                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="font-bold text-on-surface text-lg mb-2">Garden Deluxe Room</h3>
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                        <span class="material-symbols-outlined text-[18px]">bed</span>
                                        <span>2 Queen Beds</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                        <span class="material-symbols-outlined text-[18px]">potted_plant</span>
                                        <span>Garden View</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                        <span class="material-symbols-outlined text-[18px]">bathtub</span>
                                        <span>Stone Soaking Tub</span>
                                    </div>
                                </div>
                                <div class="mt-auto flex items-center justify-between">
                                    <div>
                                        <span class="font-headline-md text-headline-md text-primary">Rp {{ number_format(1200000, 0, ',', '.') }}</span>
                                        <span class="text-on-surface-variant font-label-md text-label-md">/ night</span>
                                    </div>
                                    <button class="bg-primary text-white px-6 py-2 rounded-full font-label-md text-label-md hover:bg-primary/90 transition-all active:scale-95">Pilih Kamar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sticky Booking Card -->
            <div class="lg:col-start-3">
                <div class="sticky top-28 bg-surface-container-lowest border border-outline-variant p-6 md:p-8 rounded-3xl shadow-soft space-y-6"
                     x-data="{
                        checkin: null,
                        checkout: null,
                        guests: 2,
                        pricePerNight: {{ $accommodation->price_per_night }},
                        ecoTax: 50000,
                        init() {
                            flatpickr(this.$refs.datePicker, {
                                mode: 'range',
                                minDate: 'today',
                                dateFormat: 'Y-m-d',
                                altInput: true,
                                altFormat: 'd M Y',
                                onChange: (selectedDates) => {
                                    if (selectedDates.length === 2) {
                                        this.checkin = selectedDates[0];
                                        this.checkout = selectedDates[1];
                                    } else {
                                        this.checkin = null;
                                        this.checkout = null;
                                    }
                                }
                            });
                        },
                        get nights() {
                            if (!this.checkin || !this.checkout) return 0;
                            const diffTime = this.checkout - this.checkin;
                            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                            return diffDays > 0 ? diffDays : 0;
                        },
                        get baseTotal() {
                            return this.pricePerNight * this.nights;
                        },
                        get serviceFee() {
                            return this.baseTotal * 0.1;
                        },
                        get grandTotal() {
                            return this.baseTotal > 0 ? this.baseTotal + this.serviceFee + this.ecoTax : 0;
                        },
                        format(val) {
                            return new Intl.NumberFormat('id-ID').format(val);
                        }
                     }">
                    <div class="flex justify-between items-baseline mb-6">
                        <div>
                            <span class="font-headline-md text-headline-md text-primary">Rp {{ number_format($accommodation->price_per_night, 0, ',', '.') }}</span>
                            <span class="text-on-surface-variant font-label-md text-label-md">/ night</span>
                        </div>
                        <div class="flex items-center gap-1 font-label-sm text-label-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[14px] text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-bold text-on-surface">{{ $accommodation->rating }}</span>
                            <span>• {{ $accommodation->review_count }} reviews</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 border border-outline rounded-xl">
                            <div class="col-span-2 p-3 hover:bg-surface-container transition-colors cursor-pointer relative rounded-t-xl" @click="$refs.datePicker.focus()">
                                <label class="block text-[10px] font-bold uppercase text-on-surface-variant tracking-wider">Dates</label>
                                <input type="text" x-ref="datePicker" class="w-full bg-transparent border-none p-0 focus:ring-0 font-body-md text-body-md text-on-surface outline-none" placeholder="Select check-in and check-out dates" required/>
                            </div>
                            <div class="col-span-2 relative border-t border-outline rounded-b-xl" x-data="{ open: false }" @click.away="open = false">
                                <div @click="open = !open" class="p-3 hover:bg-surface-container transition-colors cursor-pointer w-full flex flex-col justify-center rounded-b-xl">
                                    <label class="block text-[10px] font-bold uppercase text-on-surface-variant tracking-wider cursor-pointer">Guests</label>
                                    <div class="flex justify-between items-center">
                                        <span class="font-body-md text-body-md text-on-surface" x-text="guests + (guests > 1 ? ' Guests' : ' Guest')"></span>
                                        <span class="material-symbols-outlined text-on-surface-variant transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                                    </div>
                                </div>
                                
                                <!-- Custom Dropdown Menu -->
                                <div x-show="open" 
                                     x-transition.opacity.duration.200ms
                                     x-cloak
                                     class="absolute left-0 right-0 top-[105%] bg-surface-container-lowest border border-outline-variant rounded-xl shadow-soft overflow-hidden z-50 py-2">
                                    <template x-for="i in 4">
                                        <div @click="guests = i; open = false" 
                                             class="px-4 py-3 hover:bg-[#ffedd5] cursor-pointer transition-colors flex justify-between items-center"
                                             :class="guests === i ? 'bg-[#ffedd5] text-primary font-bold' : 'text-on-surface'">
                                            <span class="font-body-md text-body-md" x-text="i + (i > 1 ? ' Guests' : ' Guest')"></span>
                                            <span x-show="guests === i" class="material-symbols-outlined text-[18px] text-primary">check</span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <button class="w-full py-4 rounded-xl bg-primary text-white font-label-md text-label-md hover:brightness-110 transition-all shadow-md active:scale-95">
                            Reserve Now
                        </button>
                        <p class="text-center text-on-surface-variant text-[12px] mt-4">You won't be charged yet</p>
                    </div>
                    
                    <div class="space-y-3 pt-6 border-t border-outline-variant" x-show="nights > 0" x-cloak>
                        <div class="flex justify-between text-body-md">
                            <span>Rp {{ number_format($accommodation->price_per_night, 0, ',', '.') }} x <span x-text="nights"></span> nights</span>
                            <span>Rp <span x-text="format(baseTotal)"></span></span>
                        </div>
                        <div class="flex justify-between text-body-md">
                            <span>Service fee</span>
                            <span>Rp <span x-text="format(serviceFee)"></span></span>
                        </div>
                        <div class="flex justify-between text-body-md">
                            <span>Eco-tax (Halsea Green)</span>
                            <span>Rp 50.000</span>
                        </div>
                        <div class="flex justify-between font-bold text-on-surface text-lg pt-3 border-t border-outline-variant">
                            <span>Total</span>
                            <span>Rp <span x-text="format(grandTotal)"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location & Map -->
        <section class="mt-20 bg-surface-container-low py-20 border-y border-outline-variant/30">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
                <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
                    <div>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">The Heart of {{ explode(',', $accommodation->location)[0] ?? 'Halmahera' }}</h2>
                        <p class="text-on-surface-variant font-body-lg">Perfectly positioned for both privacy and exploration.</p>
                    </div>
                    <button class="text-primary font-label-md flex items-center gap-2 hover:underline">
                        Get Directions <span class="material-symbols-outlined">near_me</span>
                    </button>
                </div>
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 rounded-2xl overflow-hidden h-[400px] shadow-sm z-0 relative" id="accommodation-map"></div>
                    
                    <div class="space-y-6">
                        <h3 class="font-bold text-on-surface">Nearby Attractions</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-white/50 border border-outline-variant/50">
                                <div class="bg-secondary/10 p-2 rounded-lg text-secondary">
                                    <span class="material-symbols-outlined">nature_people</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface">Sibela National Park</h4>
                                    <p class="text-label-sm text-on-surface-variant">15 mins drive • Flora & Fauna</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-white/50 border border-outline-variant/50">
                                <div class="bg-primary/10 p-2 rounded-lg text-primary">
                                    <span class="material-symbols-outlined">castle</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface">Fort Bernaveld</h4>
                                    <p class="text-label-sm text-on-surface-variant">10 mins drive • Historic Site</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-white/50 border border-outline-variant/50">
                                <div class="bg-tertiary/10 p-2 rounded-lg text-tertiary">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface">Labuha Local Market</h4>
                                    <p class="text-label-sm text-on-surface-variant">8 mins drive • Culinary</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-20">
            <div class="flex items-center gap-2 mb-10">
                <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">star</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ $accommodation->rating }} · {{ $accommodation->review_count }} Reviews</h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-x-20 gap-y-12">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200">
                            <img class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Alexander+Grant&background=random"/>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Alexander Grant</h4>
                            <p class="text-label-sm text-on-surface-variant">October 2023</p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant leading-relaxed">
                        An absolutely breathtaking experience. The attention to detail in the architecture and the hospitality was world-class. The private chef prepared some of the best local seafood I've ever had. Truly a gem in Halmahera.
                    </p>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200">
                            <img class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Elena+Sorova&background=random"/>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Elena Sorova</h4>
                            <p class="text-label-sm text-on-surface-variant">September 2023</p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant leading-relaxed">
                        The views are even better in person! We loved waking up to the ocean every morning. The staff went above and beyond to organize a private diving excursion for us. Highly recommended for couples.
                    </p>
                </div>
            </div>
            
            <button class="mt-12 px-8 py-3 border border-outline rounded-xl font-label-md hover:bg-surface-container transition-colors">Show all {{ $accommodation->review_count }} reviews</button>
        </section>



        @if($accommodation->latitude && $accommodation->longitude)
        @push('styles')
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        @endpush
        @push('scripts')
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const map = L.map('accommodation-map').setView([{{ $accommodation->latitude }}, {{ $accommodation->longitude }}], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);
                    L.marker([{{ $accommodation->latitude }}, {{ $accommodation->longitude }}]).addTo(map)
                        .bindPopup("<b>{{ $accommodation->name }}</b>");
                });
            </script>
        @endpush
        @endif
    </main>
</x-public-layout>