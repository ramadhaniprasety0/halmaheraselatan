<div>
    @if($isModalOpen)
        <div class="flex flex-col gap-6">
            <!-- Header -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
                        {{ $accommodation_id ? 'Edit Accommodation' : 'Add Accommodation' }}
                    </h2>
                </div>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg relative text-sm dark:bg-red-500/15 dark:border-red-500/20 dark:text-red-500">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="store">
                <div class="flex flex-col gap-6">
                    
                    <!-- General Info -->
                    <div class="flex flex-col gap-6">
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">General Information</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Accommodation Name</label>
                                    <input type="text" wire:model="name" placeholder="Enter accommodation name" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Location</label>
                                        <input type="text" wire:model="location" placeholder="e.g., Bacan Island" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                    </div>
                                    <div>
                                        <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Type</label>
                                        <select wire:model="type" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800 transition-colors">
                                            <option value="">Select Type</option>
                                            <option value="Resort">Resort</option>
                                            <option value="Hotel">Hotel</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Eco-Lodge">Eco-Lodge</option>
                                            <option value="Homestay">Homestay</option>
                                            <option value="Guest House">Guest House</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div x-data="{ 
                                        rawPrice: @entangle('price_per_night'),
                                        displayPrice: '',
                                        init() {
                                            this.displayPrice = this.rawPrice ? new Intl.NumberFormat('en-US').format(this.rawPrice) : '';
                                            this.$watch('rawPrice', value => {
                                                if (document.activeElement !== this.$refs.input) {
                                                    this.displayPrice = value ? new Intl.NumberFormat('en-US').format(value) : '';
                                                }
                                            });
                                        },
                                        formatInput(e) {
                                            let val = e.target.value.replace(/\D/g, '');
                                            this.rawPrice = val ? parseInt(val) : null;
                                            this.displayPrice = val ? new Intl.NumberFormat('en-US').format(val) : '';
                                        }
                                    }">
                                        <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Price per Night (IDR)</label>
                                        <div class="relative">
                                            <input x-ref="input" type="text" x-model="displayPrice" @input="formatInput" style="padding-left: 3.5rem;" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                            <span class="absolute top-1/2 left-0 flex h-11 w-12 -translate-y-1/2 items-center justify-center border-r border-gray-200 text-sm text-gray-500 bg-gray-50/50 rounded-l-lg dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800/50">
                                                Rp
                                            </span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Rating</label>
                                            <input type="number" wire:model="rating" step="0.1" min="0" max="5" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                        </div>
                                        <div>
                                            <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Reviews</label>
                                            <input type="number" wire:model="review_count" min="0" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Short Description</label>
                                    <textarea wire:model="short_description" rows="2" placeholder="Brief summary for cards and lists..." class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors"></textarea>
                                </div>
                                
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Full Description</label>
                                    <textarea wire:model="description" rows="5" placeholder="Detailed information about the accommodation..." class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Map Card -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Location Map</h3>
                            <div x-data="accommodationMap" x-init="$nextTick(() => initMap($refs.mapContainer))">
                                <div x-ref="mapContainer" class="w-full h-64 rounded-lg border border-gray-200 dark:border-gray-700 z-0"></div>
                                <div x-show="showWarning" x-transition class="mt-3 p-3 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg text-sm dark:bg-yellow-500/15 dark:border-yellow-500/20 dark:text-yellow-400">
                                    ⚠️ Pin is outside the Halmahera Selatan region.
                                </div>
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label class="mb-2 block text-xs font-medium text-gray-500 dark:text-gray-400">Latitude</label>
                                        <input type="text" wire:model="latitude" readonly class="h-9 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 text-xs text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-xs font-medium text-gray-500 dark:text-gray-400">Longitude</label>
                                        <input type="text" wire:model="longitude" readonly class="h-9 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 text-xs text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media & Settings -->
                    <div class="flex flex-col gap-6">
                        
                        <!-- Media Card -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Images <span class="text-xs font-normal text-gray-400">(Max 15)</span></h3>
                            <div class="space-y-4">
                                <!-- Existing Images Grid -->
                                @if(count($existingImages) > 0)
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        @foreach($existingImages as $img)
                                            <div class="relative group rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 aspect-[4/3]">
                                                <img src="{{ $img['url'] }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                                    <button type="button" wire:click="removeExistingImage({{ $img['id'] }})" class="bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <!-- New Images Preview -->
                                @if($images && count($images) > 0)
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        @foreach($images as $index => $img)
                                            <div class="relative group rounded-lg overflow-hidden border border-blue-300 dark:border-blue-700 aspect-[4/3]">
                                                <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                                                <div class="absolute top-1 left-1 bg-blue-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">NEW</div>
                                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                                    <button type="button" wire:click="removeNewImage({{ $index }})" class="bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Upload Area -->
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-800 transition-colors">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                            <p class="text-xs text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-[10px] text-gray-400 mt-1">PNG, JPG, WEBP up to 20MB each</p>
                                        </div>
                                        <input type="file" wire:model="images" class="hidden" accept="image/*" multiple />
                                    </label>
                                </div>
                                
                                <!-- Counter -->
                                <p class="text-xs text-gray-400 text-right">
                                    {{ count($existingImages) + (is_array($images) ? count($images) : 0) }} / 15 images
                                </p>
                            </div>
                        </div>

                        <!-- Facilities -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Facilities</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach(['WiFi', 'Swimming Pool', 'Restaurant', 'Spa', 'Air Conditioning', 'Parking', 'Room Service', 'Diving Center', 'Beach Access', 'Garden', 'Gym', 'Laundry'] as $facility)
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                    <input type="checkbox" wire:model="facilities" value="{{ $facility }}" class="rounded border-gray-300 text-brand-500 focus:ring-brand-500/50 dark:border-gray-700 dark:bg-gray-900 dark:checked:bg-brand-500">
                                    {{ $facility }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Status</h3>
                            <label for="toggle_featured_acc" class="flex cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                <div class="relative">
                                    <input type="checkbox" id="toggle_featured_acc" wire:model.live="is_featured" class="sr-only" />
                                    <div class="block h-6 w-11 rounded-full {{ $is_featured ? 'bg-brand-500' : 'bg-gray-300 dark:bg-gray-600' }} transition-colors duration-200"></div>
                                    <div class="shadow-theme-sm absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white duration-300 ease-linear transform {{ $is_featured ? 'translate-x-full' : 'translate-x-0' }}"></div>
                                </div>
                                Is Featured Accommodation?
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="border-t border-gray-200 pt-5 dark:border-gray-800" style="display: flex; justify-content: flex-end; align-items: center; gap: 12px;">
                        <button type="button" wire:click="closeModal" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500/50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">
                            Save Accommodation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <!-- Table List Layout -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="relative w-full sm:w-[300px]">
                <span class="absolute left-4 top-1/2 -translate-y-1/2">
                    <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                    </svg>
                </span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search accommodations..." class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
            </div>
            <button wire:click="openModal" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/50 shadow-theme-xs whitespace-nowrap transition-colors">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 3.33333C10.4602 3.33333 10.8333 3.70643 10.8333 4.16667V9.16667H15.8333C16.2936 9.16667 16.6667 9.53976 16.6667 10C16.6667 10.4602 16.2936 10.8333 15.8333 10.8333H10.8333V15.8333C10.8333 16.2936 10.4602 16.6667 10 16.6667C9.53976 16.6667 9.16667 16.2936 9.16667 15.8333V10.8333H4.16667C3.70643 10.8333 3.33333 10.4602 3.33333 10C3.33333 9.53976 3.70643 9.16667 4.16667 9.16667H9.16667V4.16667C9.16667 3.70643 9.53976 3.33333 10 3.33333Z" fill="currentColor"></path>
                </svg>
                Add Accommodation
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm text-gray-500 dark:border-gray-800 dark:text-gray-400">
                        <th class="py-4 px-5 font-medium">Image</th>
                        <th class="py-4 px-5 font-medium">Name</th>
                        <th class="py-4 px-5 font-medium">Type</th>
                        <th class="py-4 px-5 font-medium">Location</th>
                        <th class="py-4 px-5 font-medium">Price/Night</th>
                        <th class="py-4 px-5 font-medium">Status</th>
                        <th class="py-4 px-5 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 dark:text-white/90">
                    @forelse ($accommodations as $acc)
                        <tr class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($acc->getFirstMediaUrl('default'))
                                    <img src="{{ $acc->getFirstMediaUrl('default') }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                @endif
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <div class="font-medium text-gray-800 dark:text-white/90">{{ $acc->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">★ {{ $acc->rating }}</div>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-500">
                                    {{ $acc->type }}
                                </span>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                {{ $acc->location }}
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                Rp {{ number_format($acc->price_per_night, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($acc->is_featured)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">Featured</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">Standard</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button wire:click="edit({{ $acc->id }})" class="text-gray-500 hover:text-brand-500 transition-colors">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""/>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="confirmDelete({{ $acc->id }})" class="text-gray-500 hover:text-error-600 transition-colors">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.51562 2.47487C6.84076 2.14973 7.28587 1.96875 7.75 1.96875H10.25C10.7141 1.96875 11.1592 2.14973 11.4844 2.47487C11.8095 2.80001 11.9905 3.24512 11.9905 3.70925V4.6875H14.75C15.0952 4.6875 15.375 4.96734 15.375 5.3125C15.375 5.65766 15.0952 5.9375 14.75 5.9375H14.1287L13.6588 14.3477C13.6325 14.8179 13.4266 15.2608 13.0831 15.5853C12.7396 15.9099 12.2855 16.0912 11.8145 16.0912H6.18555C5.71448 16.0912 5.26038 15.9099 4.91689 15.5853C4.5734 15.2608 4.36748 14.8179 4.34116 14.3477L3.87134 5.9375H3.25C2.90484 5.9375 2.625 5.65766 2.625 5.3125C2.625 4.96734 2.90484 4.6875 3.25 4.6875H6.00952V3.70925C6.00952 3.24512 6.19049 2.80001 6.51562 2.47487ZM7.25952 4.6875H10.7405V3.70925C10.7405 3.57658 10.6878 3.44928 10.5941 3.3556C10.5004 3.26191 10.3731 3.20925 10.2405 3.20925L7.75 3.21875C7.6268 3.21875 7.49923 3.27117 7.40522 3.36518C7.31121 3.45919 7.25879 3.58676 7.25879 3.70996L7.25952 4.6875ZM5.12329 5.9375L5.58852 14.2747C5.5987 14.4588 5.68027 14.6318 5.81617 14.7593C5.95207 14.8869 6.13109 14.9588 6.31555 14.9588L11.6845 14.8412C11.8687 14.8412 12.0453 14.7693 12.1752 14.6417C12.3051 14.5141 12.3783 14.3411 12.3815 14.1572L12.8688 5.9375H5.12329Z" fill=""/>
                                            <path d="M7.74601 7.42223C7.40875 7.42223 7.13539 7.69559 7.13539 8.03285V12.6521C7.13539 12.9893 7.40875 13.2627 7.74601 13.2627C8.08327 13.2627 8.35663 12.9893 8.35663 12.6521V8.03285C8.35663 7.69559 8.08327 7.42223 7.74601 7.42223Z" fill=""/>
                                            <path d="M10.254 7.42223C9.91673 7.42223 9.64337 7.69559 9.64337 8.03285V12.6521C9.64337 12.9893 9.91673 13.2627 10.254 13.2627C10.5912 13.2627 10.8646 12.9893 10.8646 12.6521V8.03285C10.8646 7.69559 10.5912 7.42223 10.254 7.42223Z" fill=""/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                No accommodations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $accommodations->links() }}
        </div>
    @endif
</div>
