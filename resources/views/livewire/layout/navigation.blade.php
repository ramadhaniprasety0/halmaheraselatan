<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header class="sticky top-0 z-40 flex w-full bg-white drop-shadow-1">
    <div class="flex flex-grow items-center justify-between px-4 py-4 shadow-2 md:px-6 2xl:px-11">
        
        <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <!-- Hamburger Toggle BTN -->
            <button @click="sidebarOpen = !sidebarOpen" class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm lg:hidden">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>
            <!-- Hamburger Toggle BTN -->
            <a class="block flex-shrink-0 lg:hidden" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo_halsea.png') }}" alt="Logo" class="h-8 w-auto">
            </a>
        </div>

        <div class="hidden sm:block">
            <form action="" method="POST">
                <div class="relative">
                    <button class="absolute left-0 top-1/2 -translate-y-1/2">
                        <span class="material-symbols-outlined text-gray-500 text-[20px]">search</span>
                    </button>
                    <input type="text" placeholder="Type to search..." class="w-full bg-transparent pl-9 pr-4 text-black focus:outline-none xl:w-125 border-none focus:ring-0">
                </div>
            </form>
        </div>

        <div class="flex items-center gap-3 2xsm:gap-7">
            <ul class="flex items-center gap-2 2xsm:gap-4">
                <!-- Notification Menu Area -->
                <li>
                    <button class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border border-stroke bg-gray hover:text-primary text-gray-500">
                        <span class="absolute -right-0.5 -top-0.5 z-1 h-2 w-2 rounded-full bg-red-500">
                            <span class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-red-500 opacity-75"></span>
                        </span>
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                    </button>
                </li>
            </ul>

            <!-- User Area -->
            <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                <a class="flex items-center gap-4" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">
                    <span class="hidden text-right lg:block">
                        <span class="block text-sm font-medium text-black" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></span>
                        <span class="block text-xs">{{ auth()->user()->hasRole('admin') ? 'Admin' : 'User' }}</span>
                    </span>
                    <span class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                    <span class="material-symbols-outlined hidden sm:block text-gray-500">expand_more</span>
                </a>

                <!-- Dropdown Start -->
                <div x-show="dropdownOpen" style="display: none;" class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default w-48">
                    <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-4">
                        <li>
                            <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base text-gray-600">
                                <span class="material-symbols-outlined text-[20px]">person</span>
                                My Profile
                            </a>
                        </li>
                    </ul>
                    <button wire:click="logout" class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base text-gray-600">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                        Log Out
                    </button>
                </div>
                <!-- Dropdown End -->
            </div>
            <!-- User Area -->
        </div>
    </div>
</header>
