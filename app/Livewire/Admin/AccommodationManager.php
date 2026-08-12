<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Accommodation;
use Illuminate\Support\Str;

use WireUi\Traits\WireUiActions;

class AccommodationManager extends Component
{
    use WithPagination, WithFileUploads, WireUiActions;

    public $search = '';
    public $isModalOpen = false;
    
    public $accommodation_id;
    public $name, $type, $location, $description, $short_description;
    public $rating = 0, $review_count = 0, $price_per_night = 0;
    public $is_featured = false;
    public $latitude, $longitude;
    public $facilities = [];
    public $images = [];
    public $existingImages = [];

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
        $this->accommodation_id = null;
        $this->name = '';
        $this->type = '';
        $this->location = '';
        $this->description = '';
        $this->short_description = '';
        $this->rating = 5.0;
        $this->review_count = 0;
        $this->price_per_night = 0;
        $this->is_featured = false;
        $this->latitude = null;
        $this->longitude = null;
        $this->facilities = [];
        $this->images = [];
        $this->existingImages = [];
    }

    public function edit($id)
    {
        $acc = Accommodation::findOrFail($id);
        $this->accommodation_id = $id;
        $this->name = $acc->name;
        $this->type = $acc->type;
        $this->location = $acc->location;
        $this->description = $acc->description;
        $this->short_description = $acc->short_description;
        $this->rating = $acc->rating;
        $this->review_count = $acc->review_count;
        $this->price_per_night = $acc->price_per_night;
        $this->is_featured = $acc->is_featured;
        $this->latitude = $acc->latitude;
        $this->longitude = $acc->longitude;
        $this->facilities = $acc->facilities ?? [];
        
        // Load existing media
        $this->existingImages = $acc->getMedia('default')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'name' => $media->file_name,
            ];
        })->toArray();
        
        $this->isModalOpen = true;
    }

    public function removeExistingImage($mediaId)
    {
        if ($this->accommodation_id) {
            $acc = Accommodation::find($this->accommodation_id);
            if ($acc) {
                $media = $acc->getMedia('default')->where('id', $mediaId)->first();
                if ($media) {
                    $media->delete();
                }
            }
        }
        $this->existingImages = array_values(array_filter($this->existingImages, fn($img) => $img['id'] != $mediaId));
    }

    public function removeNewImage($index)
    {
        $imgs = $this->images;
        unset($imgs[$index]);
        $this->images = array_values($imgs);
    }

    public function store()
    {
        $totalExisting = count($this->existingImages);
        $totalNew = is_array($this->images) ? count($this->images) : 0;
        $totalImages = $totalExisting + $totalNew;

        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'price_per_night' => 'numeric|min:0',
            'rating' => 'numeric|min:0|max:5',
            'review_count' => 'numeric|min:0',
            'is_featured' => 'boolean',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'images.*' => 'nullable|image|max:20480',
        ]);

        if ($totalImages > 15) {
            $this->addError('images', 'Maksimal 15 gambar yang diizinkan.');
            return;
        }

        $acc = Accommodation::updateOrCreate(
            ['id' => $this->accommodation_id],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name) . ($this->accommodation_id ? '' : '-' . time()),
                'type' => $this->type,
                'location' => $this->location,
                'description' => $this->description,
                'short_description' => $this->short_description,
                'price_per_night' => $this->price_per_night !== '' ? $this->price_per_night : 0,
                'rating' => $this->rating,
                'review_count' => $this->review_count,
                'is_featured' => $this->is_featured ? true : false,
                'latitude' => $this->latitude ?: null,
                'longitude' => $this->longitude ?: null,
                'facilities' => $this->facilities,
            ]
        );

        // Handle multiple image uploads
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $acc->addMedia($image->getRealPath())
                           ->usingName($image->getClientOriginalName())
                           ->toMediaCollection('default');
            }
        }

        $this->notification()->success(
            $title = __('Success'),
            $description = $this->accommodation_id ? __('Accommodation updated successfully.') : __('Accommodation created successfully.')
        );
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->dialog()->confirm([
            'title'       => __('Are you sure?'),
            'description' => __('Do you want to delete this accommodation?'),
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
        Accommodation::find($id)?->delete();
        $this->notification()->success(
            $title = __('Success'),
            $description = __('Accommodation deleted successfully.')
        );
    }

    public function render()
    {
        $accommodations = Accommodation::where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('location', 'like', '%'.$this->search.'%')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                        
        return view('livewire.admin.accommodation-manager', [
            'accommodations' => $accommodations
        ]);
    }
}
