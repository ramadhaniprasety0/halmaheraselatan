<x-app-layout>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-4">
        <!-- Card Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                <span class="material-symbols-outlined text-gray-800 dark:text-white/90 text-2xl">group</span>
            </div>

            <div class="flex items-end justify-between mt-5">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Users</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ \App\Models\User::count() }}
                    </h4>
                </div>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                <span class="material-symbols-outlined text-gray-800 dark:text-white/90 text-2xl">explore</span>
            </div>

            <div class="flex items-end justify-between mt-5">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Destinations</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ \App\Models\Destination::count() }}
                    </h4>
                </div>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                <span class="material-symbols-outlined text-gray-800 dark:text-white/90 text-2xl">event</span>
            </div>

            <div class="flex items-end justify-between mt-5">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Events</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ \App\Models\Event::count() }}
                    </h4>
                </div>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                <span class="material-symbols-outlined text-gray-800 dark:text-white/90 text-2xl">star_rate</span>
            </div>

            <div class="flex items-end justify-between mt-5">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Reviews</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ \App\Models\VisitorReview::count() }}
                    </h4>
                </div>
            </div>
        </div>
        <!-- Card Item End -->
    </div>
</x-app-layout>
