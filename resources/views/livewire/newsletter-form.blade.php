<div class="bg-primary text-white rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden">
    <div class="absolute inset-0 bg-white/5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Stay Updated!</h2>
            <p class="text-primary-100 text-lg mb-0">Subscribe to our newsletter and get the latest updates on destinations, events, and exclusive travel packages in Halmahera Selatan.</p>
        </div>
        <div>
            @if($success)
                <div class="bg-white/20 border border-white/30 text-white px-6 py-4 rounded-xl flex items-center gap-3 animate-fade-in">
                    <span class="material-symbols-outlined text-green-300">check_circle</span>
                    <p class="font-bold">Thank you for subscribing!</p>
                </div>
            @else
                <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <input type="email" wire:model.defer="email" placeholder="Enter your email address" class="w-full bg-white/10 border border-white/20 text-white placeholder-white/60 rounded-xl px-6 py-4 focus:ring-2 focus:ring-white focus:border-white outline-none transition-all" required>
                        @error('email') <span class="text-red-200 text-sm mt-1 block font-bold">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-brand-secondary text-white font-bold px-8 py-4 rounded-xl hover:bg-brand-secondary/90 hover:shadow-lg transition-all whitespace-nowrap flex items-center justify-center gap-2">
                        <span wire:loading.remove>Subscribe</span>
                        <span wire:loading class="material-symbols-outlined animate-spin">progress_activity</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
