<div class="bg-white rounded-3xl p-6 border border-outline-variant shadow-lg h-full flex flex-col">
    <h3 class="text-xl font-bold text-primary mb-1">Share Your Experience</h3>
    <p class="text-on-surface-variant mb-4 text-sm">We'd love to hear about your trip to Halmahera Selatan!</p>

    @if($success)
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-xl flex items-start gap-3 animate-fade-in mt-2 shadow-sm">
            <span class="material-symbols-outlined text-green-500 mt-0.5 text-2xl">task_alt</span>
            <div>
                <p class="font-bold">Review Submitted!</p>
                <p class="text-xs mt-1">Thank you for sharing. Your review is pending approval by our team.</p>
            </div>
        </div>
    @else
        <form wire:submit.prevent="submit" class="space-y-3 flex-1 flex flex-col">
            <div>
                <label class="block text-xs font-bold text-on-surface mb-1">Your Name</label>
                <input type="text" wire:model.defer="name" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" required>
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-xs font-bold text-on-surface mb-1">Rating</label>
                <div class="flex items-center gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition-transform hover:scale-110">
                            <span class="material-symbols-outlined text-2xl {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}" style="font-variation-settings: 'FILL' {{ $rating >= $i ? '1' : '0' }};">star</span>
                        </button>
                    @endfor
                </div>
                @error('rating') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col">
                <label class="block text-xs font-bold text-on-surface mb-1">Review</label>
                <textarea wire:model.defer="comment" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all resize-none h-24" placeholder="Tell us what you loved..." required></textarea>
                @error('comment') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-primary text-white font-bold py-3 mt-2 rounded-xl hover:bg-primary/90 hover:shadow-lg transition-all flex justify-center items-center gap-2">
                <span wire:loading.remove>Submit Review</span>
                <span wire:loading class="material-symbols-outlined animate-spin text-sm">progress_activity</span>
            </button>
        </form>
    @endif
</div>
