<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div class="relative w-full sm:w-[300px]">
            <span class="absolute left-4 top-1/2 -translate-y-1/2">
                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                </svg>
            </span>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users..." class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-sm text-gray-500 dark:border-gray-800 dark:text-gray-400">
                    <th class="py-4 px-5 font-medium">User</th>
                    <th class="py-4 px-5 font-medium">Email</th>
                    <th class="py-4 px-5 font-medium">Role</th>
                    <th class="py-4 px-5 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 dark:text-white/90">
                @forelse($users as $user)
                    <tr class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="py-4 px-5">
                            <div class="font-medium">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Joined {{ $user->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="py-4 px-5">{{ $user->email }}</td>
                        <td class="py-4 px-5">
                            @if($user->hasRole('admin'))
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    User
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-5 text-right">
                            @if($user->id !== auth()->id())
                                <button wire:click="toggleAdminRole({{ $user->id }})" wire:loading.attr="disabled" class="text-xs font-medium {{ $user->hasRole('admin') ? 'text-error-600 hover:text-error-700' : 'text-brand-500 hover:text-brand-600' }} transition-colors">
                                    {{ $user->hasRole('admin') ? 'Revoke Admin' : 'Make Admin' }}
                                </button>
                            @else
                                <span class="text-xs text-gray-400 italic">You</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500 dark:text-gray-400">
                            No users found matching "{{ $search }}"
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        <div class="p-4 border-t border-outline-variant">
            {{ $users->links() }}
        </div>
    </div>
</div>
