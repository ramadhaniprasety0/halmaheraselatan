<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Destination;
use Illuminate\Support\Str;

use WireUi\Traits\WireUiActions;

class DestinationManager extends Component
{
    use WithPagination, WithFileUploads, WireUiActions;

    public $search = '';
    public $isModalOpen = false;
    
    // Form fields
    public $destination_id;
    public $name, $category, $location, $description, $short_description, $rating = 0, $review_count = 0, $price = 0, $is_featured = false;
    public $latitude, $longitude;
    public $facilities = [];
    public $images = []; // Multiple images upload
    public $existingImages = []; // Track existing media for edit mode

    public function mount()
    {
        $this->rating = 5.0; // Default
    }

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
        $this->destination_id = null;
        $this->name = '';
        $this->category = '';
        $this->location = '';
        $this->description = '';
        $this->short_description = '';
        $this->rating = 5.0;
        $this->review_count = 0;
        $this->price = 0;
        $this->is_featured = false;
        $this->latitude = -0.6409; // Default South Halmahera
        $this->longitude = 127.4849;
        $this->facilities = [];
        $this->images = [];
        $this->existingImages = [];
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $this->destination_id = $id;
        $this->name = $destination->name;
        $this->category = $destination->category;
        $this->location = $destination->location;
        $this->description = $destination->description;
        $this->short_description = $destination->short_description;
        $this->rating = $destination->rating;
        $this->review_count = $destination->review_count;
        $this->price = $destination->price;
        $this->is_featured = $destination->is_featured;
        $this->latitude = $destination->latitude ?? -0.6409;
        $this->longitude = $destination->longitude ?? 127.4849;
        $this->facilities = $destination->facilities ?? [];
        
        // Load existing media
        $this->existingImages = $destination->getMedia('default')->map(function ($media) {
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
        if ($this->destination_id) {
            $destination = Destination::find($this->destination_id);
            if ($destination) {
                $media = $destination->getMedia('default')->where('id', $mediaId)->first();
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
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'price' => 'numeric',
            'rating' => 'numeric',
            'review_count' => 'numeric',
            'is_featured' => 'boolean',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'facilities' => 'nullable|array',
            'images.*' => 'nullable|image|max:20480', // Max 20MB per image
        ]);

        if ($totalImages > 10) {
            $this->addError('images', 'Maksimal 10 gambar yang diizinkan.');
            return;
        }

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name) . ($this->destination_id ? '' : '-' . time()),
            'category' => $this->category,
            'location' => $this->location,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'price' => $this->price,
            'rating' => $this->rating,
            'review_count' => $this->review_count,
            'is_featured' => $this->is_featured ? true : false,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'facilities' => $this->facilities,
        ];

        $destination = Destination::updateOrCreate(
            ['id' => $this->destination_id],
            $data
        );

        // Handle multiple image uploads
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $destination->addMedia($image->getRealPath())
                           ->usingName($image->getClientOriginalName())
                           ->toMediaCollection('default');
            }
        }

        $this->notification()->success(
            $title = __('Success'),
            $description = $this->destination_id ? __('Destination updated successfully.') : __('Destination created successfully.')
        );
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->dialog()->confirm([
            'title'       => __('Are you sure?'),
            'description' => __('Do you want to delete this destination?'),
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
        Destination::find($id)?->delete();
        $this->notification()->success(
            $title = __('Success'),
            $description = __('Destination deleted successfully.')
        );
    }

    public function render()
    {
        $destinations = Destination::where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('location', 'like', '%'.$this->search.'%')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
                        
        return view('livewire.admin.destination-manager', [
            'destinations' => $destinations
        ]);
    }
}
