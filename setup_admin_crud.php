<?php

// --- EventManager.php ---
$eventManagerCode = <<<'PHP'
<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Event;
use Illuminate\Support\Str;

class EventManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isModalOpen = false;
    
    public $event_id, $name, $location, $description, $short_description, $start_date, $end_date, $is_featured = false;
    public $image;

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->event_id = null;
        $this->name = '';
        $this->location = '';
        $this->description = '';
        $this->short_description = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->is_featured = false;
        $this->image = null;
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->event_id = $id;
        $this->name = $event->name;
        $this->location = $event->location;
        $this->description = $event->description;
        $this->short_description = $event->short_description;
        $this->start_date = $event->start_date;
        $this->end_date = $event->end_date;
        $this->is_featured = $event->is_featured;
        
        $this->isModalOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:5120',
        ]);

        $event = Event::updateOrCreate(
            ['id' => $this->event_id],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name) . ($this->event_id ? '' : '-' . time()),
                'location' => $this->location,
                'description' => $this->description,
                'short_description' => $this->short_description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'is_featured' => $this->is_featured ? true : false,
            ]
        );

        if ($this->image) {
            $event->addMedia($this->image->getRealPath())
                  ->usingName($this->image->getClientOriginalName())
                  ->toMediaCollection('default');
        }

        session()->flash('message', $this->event_id ? 'Event updated successfully.' : 'Event created successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Event::find($id)?->delete();
        session()->flash('message', 'Event deleted successfully.');
    }

    public function render()
    {
        $events = Event::where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('start_date', 'desc')
                        ->paginate(10);
                        
        return view('livewire.admin.event-manager', ['events' => $events]);
    }
}
PHP;
file_put_contents('c:\laragon\www\halsea\app\Livewire\Admin\EventManager.php', $eventManagerCode);

// --- PackageManager.php ---
$packageManagerCode = <<<'PHP'
<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\TravelPackage;
use Illuminate\Support\Str;

class PackageManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isModalOpen = false;
    
    public $package_id, $name, $theme, $description, $short_description, $duration_days, $duration_nights, $price_per_pax, $rating = 5.0, $is_featured = false;
    public $image;

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->package_id = null;
        $this->name = '';
        $this->theme = '';
        $this->description = '';
        $this->short_description = '';
        $this->duration_days = 1;
        $this->duration_nights = 1;
        $this->price_per_pax = 0;
        $this->rating = 5.0;
        $this->is_featured = false;
        $this->image = null;
    }

    public function edit($id)
    {
        $package = TravelPackage::findOrFail($id);
        $this->package_id = $id;
        $this->name = $package->name;
        $this->theme = $package->theme;
        $this->description = $package->description;
        $this->short_description = $package->short_description;
        $this->duration_days = $package->duration_days;
        $this->duration_nights = $package->duration_nights;
        $this->price_per_pax = $package->price_per_pax;
        $this->rating = $package->rating;
        $this->is_featured = $package->is_featured;
        
        $this->isModalOpen = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'theme' => 'required|string|max:100',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'duration_days' => 'required|numeric|min:1',
            'duration_nights' => 'required|numeric|min:0',
            'price_per_pax' => 'required|numeric',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:5120',
        ]);

        $package = TravelPackage::updateOrCreate(
            ['id' => $this->package_id],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name) . ($this->package_id ? '' : '-' . time()),
                'theme' => $this->theme,
                'description' => $this->description,
                'short_description' => $this->short_description,
                'duration_days' => $this->duration_days,
                'duration_nights' => $this->duration_nights,
                'price_per_pax' => $this->price_per_pax,
                'rating' => $this->rating,
                'is_featured' => $this->is_featured ? true : false,
            ]
        );

        if ($this->image) {
            $package->addMedia($this->image->getRealPath())
                  ->usingName($this->image->getClientOriginalName())
                  ->toMediaCollection('default');
        }

        session()->flash('message', $this->package_id ? 'Package updated successfully.' : 'Package created successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        TravelPackage::find($id)?->delete();
        session()->flash('message', 'Package deleted successfully.');
    }

    public function render()
    {
        $packages = TravelPackage::where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                        
        return view('livewire.admin.package-manager', ['packages' => $packages]);
    }
}
PHP;
file_put_contents('c:\laragon\www\halsea\app\Livewire\Admin\PackageManager.php', $packageManagerCode);


// --- event-manager.blade.php ---
$eventBlade = <<<'HTML'
<div>
    <div class="flex justify-between items-center mb-6">
        <div class="w-1/3">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search events..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <button wire:click="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Add Event</button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">{{ session('message') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow mb-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ $event->name }}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit({{ $event->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $event->id }})" wire:confirm="Delete this event?" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No events found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $events->links() }}</div>

    @if($isModalOpen)
        <div class="fixed z-50 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form wire:submit.prevent="store">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">{{ $event_id ? 'Edit Event' : 'Add Event' }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" wire:model="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" wire:model="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" wire:model="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Short Description</label>
                                    <textarea wire:model="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Full Description</label>
                                    <textarea wire:model="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Image</label>
                                    <input type="file" wire:model="image" class="mt-1 block w-full text-sm text-gray-500">
                                    @if ($image) <img src="{{ $image->temporaryUrl() }}" class="w-32 mt-2 rounded"> @endif
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <input type="checkbox" wire:model="is_featured" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <label class="ml-2 block text-sm text-gray-900">Featured Event</label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                            <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
HTML;
file_put_contents('c:\laragon\www\halsea\resources\views\livewire\admin\event-manager.blade.php', $eventBlade);


// --- package-manager.blade.php ---
$packageBlade = <<<'HTML'
<div>
    <div class="flex justify-between items-center mb-6">
        <div class="w-1/3">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search packages..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <button wire:click="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Add Package</button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">{{ session('message') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow mb-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Theme</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price (Pax)</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($packages as $package)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ $package->name }}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ $package->theme }}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $package->duration_days }}D/{{ $package->duration_nights }}N</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($package->price_per_pax, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit({{ $package->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $package->id }})" wire:confirm="Delete this package?" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No packages found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $packages->links() }}</div>

    @if($isModalOpen)
        <div class="fixed z-50 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form wire:submit.prevent="store">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">{{ $package_id ? 'Edit Package' : 'Add Package' }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Theme</label>
                                    <input type="text" wire:model="theme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Duration (Days)</label>
                                    <input type="number" wire:model="duration_days" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Duration (Nights)</label>
                                    <input type="number" wire:model="duration_nights" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Short Description</label>
                                    <textarea wire:model="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Full Description</label>
                                    <textarea wire:model="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Price (Per Pax)</label>
                                    <input type="number" wire:model="price_per_pax" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                                    <input type="number" step="0.1" wire:model="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Image</label>
                                    <input type="file" wire:model="image" class="mt-1 block w-full text-sm text-gray-500">
                                    @if ($image) <img src="{{ $image->temporaryUrl() }}" class="w-32 mt-2 rounded"> @endif
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <input type="checkbox" wire:model="is_featured" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <label class="ml-2 block text-sm text-gray-900">Featured Package</label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                            <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
HTML;
file_put_contents('c:\laragon\www\halsea\resources\views\livewire\admin\package-manager.blade.php', $packageBlade);

echo "Admin CRUD Logic and Views Generated.";

