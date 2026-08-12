<div>
    @if($isModalOpen)
        <!-- 2 Column Form Layout -->
        <div class="flex flex-col gap-6">
            <!-- Header -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">
                        {{ $package_id ? 'Edit Package' : 'Add Package' }}
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
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-8">
                    
                    <!-- Left Column (General Info) -->
                    <div class="col-span-1 lg:col-span-2 flex flex-col gap-6">
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">General Information</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Package Name</label>
                                    <input type="text" wire:model="name" placeholder="Enter package name" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Theme</label>
                                        <div class="relative bg-transparent">
                                            <select wire:model="theme" class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800 transition-colors">
                                                <option value="">Select Theme</option>
                                                <option value="Beaches">Beaches & Islands</option>
                                                <option value="Historical">Historical Sites</option>
                                                <option value="Nature">Nature & Wildlife</option>
                                                <option value="Culture">Culture & Heritage</option>
                                                <option value="Waterfalls">Waterfalls</option>
                                                <option value="Diving">Diving Spots</option>
                                                <option value="Adventure">Adventure</option>
                                            </select>
                                            <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Duration (Days)</label>
                                        <input type="number" wire:model="duration_days" min="1" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                    </div>
                                    <div class="col-span-1">
                                        <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Duration (Nights)</label>
                                        <input type="number" wire:model="duration_nights" min="0" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Short Description</label>
                                    <textarea wire:model="short_description" rows="2" placeholder="Brief summary for cards and lists..." class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors"></textarea>
                                </div>
                                
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Full Description</label>
                                    <textarea wire:model="description" rows="5" placeholder="Detailed information about the package..." class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (Media, Pricing, Status) -->
                    <div class="col-span-1 flex flex-col gap-6">
                        
                        <!-- Media Card -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Package Image</h3>
                            
                            @error('image') <p style="color: #ef4444; font-size: 13px; margin-bottom: 8px;">{{ $message }}</p> @enderror

                            <!-- Existing Image (when editing) -->
                            @if($existingImage)
                                <label style="display: block; font-size: 13px; font-weight: 500; color: #94a3b8; margin-bottom: 8px;">Gambar Tersimpan</label>
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 12px;">
                                    <div style="position: relative; border-radius: 8px; overflow: hidden; border: 1px solid #374151; aspect-ratio: 1/1;">
                                        <img src="{{ $existingImage }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            @endif

                            <!-- Newly selected image preview -->
                            @if($image)
                                <label style="display: block; font-size: 13px; font-weight: 500; color: #94a3b8; margin-bottom: 8px;">Gambar Baru</label>
                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 12px;">
                                    <div style="position: relative; border-radius: 8px; overflow: hidden; border: 1px solid #374151; aspect-ratio: 1/1;">
                                        <img src="{{ $image->temporaryUrl() }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                            
                            <div class="relative block w-full appearance-none rounded-lg border border-dashed border-gray-300 bg-transparent px-4 py-4 text-center dark:border-gray-700 hover:border-brand-500 hover:bg-brand-50/50 dark:hover:bg-brand-500/5 transition-colors cursor-pointer">
                                <input type="file" wire:model="image" class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none" accept="image/*">
                                <div class="flex flex-col items-center justify-center space-y-2 text-gray-500 dark:text-gray-400">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 shadow-theme-xs">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.00004 7.66663L8.00004 4.66663L11 7.66663" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M8 4.66663V11.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <div class="text-sm">
                                        <span class="font-medium text-brand-500">Klik untuk upload</span> atau drag & drop
                                    </div>
                                    <p class="text-xs">PNG, JPG atau GIF (maks. 5MB)</p>
                                </div>
                            </div>
                            <div wire:loading wire:target="image" style="color: #6366f1; font-size: 13px; margin-top: 8px; font-weight: 500;">Mengupload gambar...</div>
                        </div>

                        <!-- Pricing & Status Card -->
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                            <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90">Pricing & Status</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-400">Price per Pax (Rp)</label>
                                    <div class="relative">
                                        <input type="number" wire:model="price_per_pax" style="padding-left: 3.5rem;" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
                                        <span class="absolute top-1/2 left-0 flex h-11 w-12 -translate-y-1/2 items-center justify-center border-r border-gray-200 text-sm text-gray-500 bg-gray-50/50 rounded-l-lg dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800/50">
                                            Rp
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="toggle_status" class="flex cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                        <div class="relative">
                                            <input type="checkbox" id="toggle_status" wire:model.live="is_featured" class="sr-only" />
                                            <div class="block h-6 w-11 rounded-full {{ $is_featured ? 'bg-brand-500' : 'bg-gray-300 dark:bg-gray-600' }} transition-colors duration-200"></div>
                                            <div class="shadow-theme-sm absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white duration-300 ease-linear transform {{ $is_featured ? 'translate-x-full' : 'translate-x-0' }}"></div>
                                        </div>
                                        Is Featured Package?
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Form Actions -->
                <div class="col-span-1 lg:col-span-3 border-t border-gray-200 pt-5 dark:border-gray-800" style="display: flex; justify-content: flex-end; align-items: center; gap: 12px;">
                    <button type="button" wire:click="closeModal" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500/50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">
                        Save Package
                    </button>
                </div>
            </form>
        </div>
    @else
        <!-- Original Table Layout -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="relative w-full sm:w-[300px]">
                <span class="absolute left-4 top-1/2 -translate-y-1/2">
                    <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                    </svg>
                </span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search packages..." class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 transition-colors">
            </div>
            <button wire:click="openModal" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/50 shadow-theme-xs whitespace-nowrap transition-colors">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 3.33333C10.4602 3.33333 10.8333 3.70643 10.8333 4.16667V9.16667H15.8333C16.2936 9.16667 16.6667 9.53976 16.6667 10C16.6667 10.4602 16.2936 10.8333 15.8333 10.8333H10.8333V15.8333C10.8333 16.2936 10.4602 16.6667 10 16.6667C9.53976 16.6667 9.16667 16.2936 9.16667 15.8333V10.8333H4.16667C3.70643 10.8333 3.33333 10.4602 3.33333 10C3.33333 9.53976 3.70643 9.16667 4.16667 9.16667H9.16667V4.16667C9.16667 3.70643 9.53976 3.33333 10 3.33333Z" fill="currentColor"></path>
                </svg>
                Add Package
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm text-gray-500 dark:border-gray-800 dark:text-gray-400">
                        <th class="py-4 px-5 font-medium">Image</th>
                        <th class="py-4 px-5 font-medium">Name</th>
                        <th class="py-4 px-5 font-medium">Theme</th>
                        <th class="py-4 px-5 font-medium">Duration</th>
                        <th class="py-4 px-5 font-medium">Price (Pax)</th>
                        <th class="py-4 px-5 font-medium">Status</th>
                        <th class="py-4 px-5 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800 dark:text-white/90">
                    @forelse ($packages as $package)
                        <tr class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($package->getFirstMediaUrl('default'))
                                    <img src="{{ $package->getFirstMediaUrl('default') }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Img</div>
                                @endif
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <div class="font-medium text-gray-800 dark:text-white/90">{{ $package->name }}</div>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-500">
                                    {{ $package->theme }}
                                </span>
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                {{ $package->duration_days }}D / {{ $package->duration_nights }}N
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                Rp {{ number_format($package->price_per_pax, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($package->is_featured)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">Featured</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">Standard</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button wire:click="edit({{ $package->id }})" class="text-gray-500 hover:text-brand-500 transition-colors">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" fill=""/>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="confirmDelete({{ $package->id }})" class="text-gray-500 hover:text-error-600 transition-colors">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4357 5.43285C13.4357 5.09559 13.1623 4.82223 12.8251 4.82223H5.17482C4.83756 4.82223 4.5642 5.09559 4.5642 5.43285C4.5642 5.77011 4.83756 6.04347 5.17482 6.04347H12.8251C13.1623 6.04347 13.4357 5.77011 13.4357 5.43285ZM12.0163 13.5183C12.3486 13.1708 12.5513 12.7093 12.5761 12.213L12.9827 4.08388C13.3197 4.06733 13.5802 3.78206 13.5637 3.44503C13.5471 3.108 13.2618 2.84752 12.9248 2.86407L5.07513 3.25052C4.7381 3.26707 4.47762 3.55235 4.49417 3.88938C4.51072 4.2264 4.79599 4.48688 5.13302 4.47034L5.41908 10.191C5.44146 10.6385 5.25301 11.0658 4.90805 11.3857C4.56309 11.7056 4.09506 11.8876 3.60679 11.8876C3.26953 11.8876 2.99617 12.161 2.99617 12.4982C2.99617 12.8355 3.26953 13.1088 3.60679 13.1088C4.38596 13.1088 5.13264 12.8185 5.68305 12.3082C6.23346 11.7978 6.53392 11.116 6.49823 10.4024L6.19532 4.34444L11.7583 4.07055L11.3599 12.0401C11.344 12.3582 11.2141 12.6539 11.001 12.8767C10.7879 13.0994 10.5056 13.2343 10.1983 13.2573C9.89104 13.2803 9.57962 13.1895 9.32185 13.0034C9.06408 12.8174 8.87702 12.5484 8.79462 12.2464C8.70519 11.9185 8.36709 11.7255 8.03923 11.8149C7.71137 11.9043 7.51838 12.2424 7.60781 12.5703C7.73812 13.0483 8.03378 13.4735 8.44122 13.7674C8.84865 14.0613 9.34091 14.2048 9.82672 14.1685C10.3125 14.1322 10.759 13.9189 11.0957 13.5663C11.4324 13.2137 11.6378 12.7485 11.6628 12.2497L11.7618 10.2709L12.0163 13.5183Z" fill=""/>
                                            <path d="M7.74601 7.42223C7.40875 7.42223 7.13539 7.69559 7.13539 8.03285V14.6521C7.13539 14.9893 7.40875 15.2627 7.74601 15.2627C8.08327 15.2627 8.35663 14.9893 8.35663 14.6521V8.03285C8.35663 7.69559 8.08327 7.42223 7.74601 7.42223Z" fill=""/>
                                            <path d="M10.254 7.42223C9.91673 7.42223 9.64337 7.69559 9.64337 8.03285V14.6521C9.64337 14.9893 9.91673 15.2627 10.254 15.2627C10.5912 15.2627 10.8646 14.9893 10.8646 14.6521V8.03285C10.8646 7.69559 10.5912 7.42223 10.254 7.42223Z" fill=""/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                No packages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $packages->links() }}
        </div>
    @endif
</div>