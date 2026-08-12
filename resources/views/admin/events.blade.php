<x-app-layout>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white/90 mb-6">Manage Events</h2>
        <livewire:admin.event-manager />
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('eventMap', () => ({
                    showWarning: false,
                    map: null,
                    marker: null,
                    initMap(mapElement) {
                        let lat = this.$wire.latitude || -0.6409;
                        let lng = this.$wire.longitude || 127.4849;

                        const halmaheraBounds = L.latLngBounds([
                            [-2.5, 126.5], 
                            [0.5, 128.8]   
                        ]);

                        this.map = L.map(mapElement, {
                            center: [lat, lng],
                            zoom: 9,
                            maxBounds: halmaheraBounds,
                            maxBoundsViscosity: 1.0,
                            minZoom: 7
                        });

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(this.map);

                        this.marker = L.marker([lat, lng], {
                            draggable: true
                        }).addTo(this.map);

                        this.marker.on('dragend', (e) => {
                            const position = this.marker.getLatLng();
                            this.updatePosition(position.lat, position.lng);
                        });

                        this.map.on('click', (e) => {
                            this.marker.setLatLng(e.latlng);
                            this.updatePosition(e.latlng.lat, e.latlng.lng);
                        });
                        
                        setTimeout(() => {
                            this.map.invalidateSize();
                        }, 500);
                    },
                    updatePosition(newLat, newLng) {
                        const halmaheraBounds = L.latLngBounds([
                            [-2.5, 126.5], 
                            [0.5, 128.8]   
                        ]);
                        
                        if (!halmaheraBounds.contains([newLat, newLng])) {
                            this.showWarning = true;
                            setTimeout(() => this.showWarning = false, 5000);
                        } else {
                            this.showWarning = false;
                        }
                        
                        this.$wire.set('latitude', newLat);
                        this.$wire.set('longitude', newLng);
                    }
                }));
            });
        </script>
    @endpush
</x-app-layout>
