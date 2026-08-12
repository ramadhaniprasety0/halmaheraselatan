<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-99999 border-r border-gray-200"
    x-data="{
        isActive(path) {
            return window.location.pathname.startsWith(path) || window.location.pathname === path;
        }
    }"
    :class="{
        'w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
        'w-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full xl:translate-x-0': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)">
    
    <!-- Logo Section -->
    <div class="pt-8 pb-7 flex"
        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
        'xl:justify-center' :
        'justify-start'">
        <a href="/">
            <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                src="{{ asset('images/logo_halsea.png') }}" alt="Logo" class="h-10 w-auto" />
            <img x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen"
                src="{{ asset('images/logo_halsea.png') }}" alt="Logo" class="h-8 w-auto" />
        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">
                <div>
                    <!-- Menu Group Title -->
                    <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-400"
                        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
                        'lg:justify-center' : 'justify-start'">
                        <template
                            x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                            <span>MENU Utama</span>
                        </template>
                        <template x-if="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">
                            <span class="material-symbols-outlined text-gray-400">more_horiz</span>
                        </template>
                    </h2>

                    <!-- Menu Items -->
                    <ul class="flex flex-col gap-1">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('dashboard') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('dashboard', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('dashboard', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        @role('admin')
                        <!-- Destinations -->
                        <li>
                            <a href="{{ route('admin.destinations') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('admin.destinations', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('admin.destinations', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">explore</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Destinations
                                </span>
                            </a>
                        </li>

                        <!-- Events -->
                        <li>
                            <a href="{{ route('admin.events') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('admin.events', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('admin.events', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">event</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Events
                                </span>
                            </a>
                        </li>

                        <!-- Accommodations -->
                        <li>
                            <a href="{{ route('admin.accommodations') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('admin.accommodations', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('admin.accommodations', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">hotel</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Accommodations
                                </span>
                            </a>
                        </li>

                        <!-- Packages -->
                        <li>
                            <a href="{{ route('admin.packages') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('admin.packages', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('admin.packages', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">luggage</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Packages
                                </span>
                            </a>
                        </li>

                        <!-- Reviews -->
                        <li>
                            <a href="{{ route('admin.reviews') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('admin.reviews', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('admin.reviews', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">star_rate</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Reviews
                                </span>
                            </a>
                        </li>

                        <!-- Users -->
                        <li>
                            <a href="{{ route('admin.users') }}" class="menu-item group"
                                :class="[
                                    isActive('{{ route('admin.users', [], false) }}') ? 'menu-item-active' : 'menu-item-inactive',
                                    (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                                ]">
                                <span :class="isActive('{{ route('admin.users', [], false) }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    <span class="material-symbols-outlined text-[20px]">group</span>
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Users
                                </span>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="$store.sidebar.isMobileOpen" @click="$store.sidebar.setMobileOpen(false)" class="fixed z-50 h-screen w-full bg-gray-900/50 lg:hidden"></div>
