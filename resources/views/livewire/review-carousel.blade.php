<div class="h-full flex flex-col max-h-[500px]">
    @if($reviews->count() > 0)
        <div class="bg-surface-container-low rounded-3xl p-4 md:p-6 h-full border border-outline-variant flex flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto custom-scrollbar pr-2">
                <div class="flex flex-col gap-3">
                @foreach($reviews as $review)
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-outline-variant hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex text-yellow-400 text-base">
                                {{ str_repeat('★', $review->rating) }}<span class="text-gray-200">{{ str_repeat('★', 5 - $review->rating) }}</span>
                            </div>
                            <span class="text-[10px] text-on-surface-variant bg-surface px-2 py-1 rounded-md">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-on-surface-variant text-sm italic mb-3 leading-relaxed">"{{ $review->comment }}"</p>
                        
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold text-sm">
                                {{ strtoupper(substr($review->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-on-surface text-xs">{{ $review->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
    @else
        <div class="bg-surface-container-high rounded-3xl p-12 text-center h-full flex flex-col justify-center items-center border border-dashed border-outline">
            <span class="material-symbols-outlined text-5xl text-outline mb-4">rate_review</span>
            <p class="text-on-surface-variant font-bold text-lg">No reviews yet.</p>
            <p class="text-sm text-outline mt-1">Be the first to share your experience!</p>
        </div>
    @endif
</div>
