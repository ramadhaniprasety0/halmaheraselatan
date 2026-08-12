<div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-sm text-gray-500 dark:border-gray-800 dark:text-gray-400">
                    <th class="py-4 px-5 font-medium">Visitor Name</th>
                    <th class="py-4 px-5 font-medium w-1/2">Review</th>
                    <th class="py-4 px-5 font-medium">Status</th>
                    <th class="py-4 px-5 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 dark:text-white/90">
                @forelse ($reviews as $review)
                    <tr class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="py-4 px-5 whitespace-nowrap">
                            <div class="font-medium text-gray-800 dark:text-white/90">{{ $review->name }}</div>
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center text-yellow-400 text-sm mb-1">
                                {{ str_repeat('★', $review->rating) }}<span class="text-gray-300 dark:text-gray-600">{{ str_repeat('★', 5 - $review->rating) }}</span>
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 italic">"{{ $review->comment }}"</div>
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap">
                            @if($review->is_approved)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">Approved</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">Pending</span>
                            @endif
                        </td>
                        <td class="py-4 px-5 whitespace-nowrap text-right">
                            <button wire:click="toggleApproval({{ $review->id }})" class="text-xs font-medium mr-3 transition-colors {{ $review->is_approved ? 'text-warning-600 hover:text-warning-700' : 'text-success-600 hover:text-success-700' }}">
                                {{ $review->is_approved ? 'Reject' : 'Approve' }}
                            </button>
                            <button type="button" wire:click="confirmDeleteReview({{ $review->id }})" class="text-xs font-medium text-error-600 hover:text-error-700 transition-colors">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500 dark:text-gray-400">
                            No reviews found yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>
