<x-public-layout>
    <div class="pt-24 pb-0 bg-surface h-screen flex flex-col">
        <div class="px-margin-mobile md:px-margin-desktop w-full max-w-container-max mx-auto mb-6 flex-shrink-0">
            <h1 class="font-headline-xl text-headline-xl text-primary mb-2">{{ __('Interactive Map') }}</h1>
            <p class="text-on-surface-variant font-body-lg">{{ __('Explore all tourist destinations in South Halmahera.') }}</p>
        </div>
        
        <!-- Map Container -->
        <div class="flex-grow w-full relative z-0">
            <div id="map" class="w-full h-full"></div>
            
            <!-- Custom Legend / Overlay -->
            <div class="absolute bottom-8 right-8 z-[1000] bg-white p-4 rounded-xl shadow-xl border border-outline-variant hidden md:block" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                <h4 class="font-bold text-primary mb-3 text-sm" style="color: #1c1c19;">{{ __('Legend') }}</h4>
                <ul class="space-y-3 text-xs">
                    <li class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-7 h-7 bg-[#006b54] rounded-full border border-white shadow-sm text-white">
                            <span class="material-symbols-outlined" style="font-size: 14px; display: block;">explore</span>
                        </div>
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('Destination') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-7 h-7 bg-[#b91c1c] rounded-full border border-white shadow-sm text-white">
                            <span class="material-symbols-outlined" style="font-size: 14px; display: block;">event</span>
                        </div>
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('Event') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Default center point for South Halmahera
            var map = L.map('map').setView([-0.6305, 127.4815], 8);

            // OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Map data from controller
            var destinations = @json($destinations);
            var events = @json($events);

            // Custom Icon for Destinations (Green Pin)
            var destIcon = L.divIcon({
                html: `
                    <div style="display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; background-color: #006b54; border: 2.5px solid #ffffff; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.25); color: #ffffff;">
                        <span class="material-symbols-outlined" style="font-size: 18px; display: block;">explore</span>
                    </div>
                `,
                className: 'custom-dest-marker',
                iconSize: [34, 34],
                iconAnchor: [17, 34],
                popupAnchor: [0, -34]
            });

            // Custom Icon for Events (Red Pin)
            var eventIcon = L.divIcon({
                html: `
                    <div style="display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; background-color: #b91c1c; border: 2.5px solid #ffffff; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.25); color: #ffffff;">
                        <span class="material-symbols-outlined" style="font-size: 18px; display: block;">event</span>
                    </div>
                `,
                className: 'custom-event-marker',
                iconSize: [34, 34],
                iconAnchor: [17, 34],
                popupAnchor: [0, -34]
            });

            // Localized labels from Laravel
            var translations = {
                exploreDetails: "{{ __('Explore Detail') }}",
                categories: {
                    "Beaches": "{{ __('Beaches') }}",
                    "Historical": "{{ __('Historical') }}",
                    "Nature": "{{ __('Nature') }}",
                    "Culture": "{{ __('Culture') }}",
                    "Waterfalls": "{{ __('Waterfalls') }}",
                    "Diving": "{{ __('Diving') }}",
                    "Adventure": "{{ __('Adventure') }}"
                }
            };

            // Add Destination markers
            destinations.forEach(function(dest) {
                if(dest.latitude && dest.longitude) {
                    var marker = L.marker([dest.latitude, dest.longitude], {icon: destIcon}).addTo(map);
                    
                    var categoryDisplay = translations.categories[dest.category] || dest.category;
                    var exploreText = translations.exploreDetails;

                    var popupContent = `
                        <div class="overflow-hidden bg-white dark:bg-gray-900" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                            <!-- Image Header -->
                            <div class="relative w-full overflow-hidden bg-gray-100" style="height: 140px; position: relative;">
                                <img src="${dest.image_url}" class="h-full w-full object-cover" style="width: 100%; height: 100%; object-fit: cover;" alt="${dest.name}">
                                <div class="absolute inset-0" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 100%); pointer-events: none;"></div>
                                <span style="position: absolute; top: 12px; left: 12px; background-color: rgba(255, 255, 255, 0.95); padding: 2px 8px; border-radius: 9999px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #006b54; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                    ${categoryDisplay}
                                </span>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="p-4" style="padding: 16px;">
                                <h3 class="font-bold text-gray-950 dark:text-white" style="font-size: 16px; font-weight: 700; color: #1c1c19; margin-bottom: 6px; line-height: 1.3;">
                                    ${dest.name}
                                </h3>
                                
                                <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #574235; margin-bottom: 16px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px; color: #006b54;">location_on</span>
                                    <span>${dest.location}</span>
                                </div>
                                
                                <a href="/destinations/${dest.slug}" class="popup-btn" style="display: flex; align-items: center; justify-content: center; gap: 6px; width: 100%; background-color: #006b54; color: #ffffff !important; font-size: 12px; font-weight: 600; padding: 10px 16px; border-radius: 10px; text-decoration: none !important; transition: background-color 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 107, 84, 0.15), 0 2px 4px -1px rgba(0, 107, 84, 0.1);">
                                    <span>${exploreText}</span>
                                    <span class="material-symbols-outlined" style="font-size: 14px; color: #ffffff;">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    `;
                    
                    marker.bindPopup(popupContent);
                }
            });

            // Add Event markers
            events.forEach(function(evt) {
                if(evt.latitude && evt.longitude) {
                    var marker = L.marker([evt.latitude, evt.longitude], {icon: eventIcon}).addTo(map);
                    
                    var exploreText = translations.exploreDetails;
                    var dateDisplay = '';
                    if (evt.start_date) {
                        dateDisplay = evt.start_date;
                        if (evt.end_date && evt.end_date !== evt.start_date) {
                            dateDisplay += ' - ' + evt.end_date;
                        }
                    }

                    var popupContent = `
                        <div class="overflow-hidden bg-white dark:bg-gray-900" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                            <!-- Image Header -->
                            <div class="relative w-full overflow-hidden bg-gray-100" style="height: 140px; position: relative;">
                                <img src="${evt.image_url}" class="h-full w-full object-cover" style="width: 100%; height: 100%; object-fit: cover;" alt="${evt.name}">
                                <div class="absolute inset-0" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 100%); pointer-events: none;"></div>
                                <span style="position: absolute; top: 12px; left: 12px; background-color: #b91c1c; padding: 2px 8px; border-radius: 9999px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                    EVENT
                                </span>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="p-4" style="padding: 16px;">
                                <h3 class="font-bold text-gray-950 dark:text-white" style="font-size: 16px; font-weight: 700; color: #1c1c19; margin-bottom: 6px; line-height: 1.3;">
                                    ${evt.name}
                                </h3>
                                
                                <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #574235; margin-bottom: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px; color: #b91c1c;">location_on</span>
                                    <span>${evt.location}</span>
                                </div>
                                
                                <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #574235; margin-bottom: 16px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px; color: #b91c1c;">calendar_today</span>
                                    <span>${dateDisplay}</span>
                                </div>
                                
                                <a href="/events/${evt.slug}" class="popup-btn event-btn" style="display: flex; align-items: center; justify-content: center; gap: 6px; width: 100%; background-color: #b91c1c; color: #ffffff !important; font-size: 12px; font-weight: 600; padding: 10px 16px; border-radius: 10px; text-decoration: none !important; transition: background-color 0.2s; box-shadow: 0 4px 6px -1px rgba(185, 28, 28, 0.15), 0 2px 4px -1px rgba(185, 28, 28, 0.15);">
                                    <span>${exploreText}</span>
                                    <span class="material-symbols-outlined" style="font-size: 14px; color: #ffffff;">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    `;
                    
                    marker.bindPopup(popupContent);
                }
            });
        });
    </script>

    <style>
        /* Override leaflet z-index so it doesn't overlap our fixed header/nav */
        .leaflet-pane {
            z-index: 10;
        }
        .leaflet-top, .leaflet-bottom {
            z-index: 10;
        }
        
        /* Adjust layout to ensure map fills space but header is visible */
        header.fixed {
            z-index: 50 !important;
        }

        /* Premium Floating Card Customizations for Leaflet Popup */
        .leaflet-popup-content-wrapper {
            padding: 0 !important;
            overflow: hidden;
            border-radius: 16px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }
        .leaflet-popup-content {
            margin: 0 !important;
            width: 260px !important;
        }
        .leaflet-popup-close-button {
            padding: 10px 10px 0 0 !important;
            color: #ffffff !important;
            font-size: 18px !important;
            z-index: 999;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }
        .leaflet-popup-close-button:hover {
            color: #ffb786 !important;
        }
        .leaflet-popup-content a.popup-btn:hover {
            background-color: #00503e !important;
        }
        .leaflet-popup-content a.event-btn:hover {
            background-color: #991b1b !important;
        }
    </style>
</x-public-layout>
