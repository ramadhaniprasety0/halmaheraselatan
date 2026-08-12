<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\TravelPackage;
use Illuminate\Support\Str;

use WireUi\Traits\WireUiActions;

class PackageManager extends Component
{
    use WithPagination, WithFileUploads, WireUiActions;

    public $search = '';
    public $isModalOpen = false;
    
    public $package_id, $name, $theme, $description, $short_description, $duration_days, $duration_nights, $price_per_pax, $rating = 5.0, $is_featured = false;
    public $image;
    public $existingImage;

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
        $this->existingImage = null;
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
        $this->existingImage = $package->getFirstMediaUrl('default');
        
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
            $package->clearMediaCollection('default');
            $package->addMedia($this->image->getRealPath())
                  ->usingName($this->image->getClientOriginalName())
                  ->toMediaCollection('default');
        }

        $this->notification()->success(
            $title = __('Success'),
            $description = $this->package_id ? __('Package updated successfully.') : __('Package created successfully.')
        );
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->dialog()->confirm([
            'title'       => __('Are you sure?'),
            'description' => __('Do you want to delete this travel package?'),
            'icon'        => 'error',
            'accept'      => [
                'label'  => __('Yes, delete it'),
                'method' => 'delete',
                'params' => $id,
            ],
            'reject' => [
                'label'  => __('Cancel'),
            ],
        ]);
    }

    public function delete($id)
    {
        TravelPackage::find($id)?->delete();
        $this->notification()->success(
            $title = __('Success'),
            $description = __('Package deleted successfully.')
        );
    }

    public function render()
    {
        $packages = TravelPackage::where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                        
        return view('livewire.admin.package-manager', ['packages' => $packages]);
    }
}