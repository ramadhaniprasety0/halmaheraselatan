<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Event;
use Illuminate\Support\Str;

use WireUi\Traits\WireUiActions;

class EventManager extends Component
{
    use WithPagination, WithFileUploads, WireUiActions;

    public $search = '';
    public $isModalOpen = false;
    
    public $event_id, $name, $location, $description, $short_description, $start_date, $end_date, $is_featured = false, $price, $audience, $event_type;
    public $image;
    public $existingImage;
    public $latitude, $longitude;
    public $schedule = [];

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

    public function addScheduleDay()
    {
        $this->schedule[] = [
            'day' => '',
            'title' => '',
            'items' => []
        ];
    }

    public function removeScheduleDay($index)
    {
        unset($this->schedule[$index]);
        $this->schedule = array_values($this->schedule);
    }

    public function addScheduleItem($dayIndex)
    {
        $this->schedule[$dayIndex]['items'][] = [
            'time' => '',
            'description' => ''
        ];
    }

    public function removeScheduleItem($dayIndex, $itemIndex)
    {
        unset($this->schedule[$dayIndex]['items'][$itemIndex]);
        $this->schedule[$dayIndex]['items'] = array_values($this->schedule[$dayIndex]['items']);
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
        $this->price = null;
        $this->image = null;
        $this->existingImage = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->audience = null;
        $this->event_type = null;
        $this->schedule = [];
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
        $this->price = $event->price;
        $this->is_featured = $event->is_featured;
        $this->existingImage = $event->getFirstMediaUrl('default');
        $this->latitude = $event->latitude;
        $this->longitude = $event->longitude;
        $this->audience = $event->audience;
        $this->event_type = $event->event_type;
        $this->schedule = is_array($event->schedule) ? $event->schedule : [];
        
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
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:5120',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'audience' => 'nullable|string|max:255',
            'event_type' => 'nullable|string|max:255',
            'schedule' => 'nullable|array',
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
                'price' => $this->price !== '' ? $this->price : null,
                'is_featured' => $this->is_featured ? true : false,
                'latitude' => $this->latitude ?: null,
                'longitude' => $this->longitude ?: null,
                'audience' => $this->audience ?: null,
                'event_type' => $this->event_type ?: null,
                'schedule' => $this->schedule,
            ]
        );

        if ($this->image) {
            $event->clearMediaCollection('default');
            $event->addMedia($this->image->getRealPath())
                  ->usingName($this->image->getClientOriginalName())
                  ->toMediaCollection('default');
        }

        $this->notification()->success(
            $title = __('Success'),
            $description = $this->event_id ? __('Event updated successfully.') : __('Event created successfully.')
        );
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->dialog()->confirm([
            'title'       => __('Are you sure?'),
            'description' => __('Do you want to delete this event?'),
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
        Event::find($id)?->delete();
        $this->notification()->success(
            $title = __('Success'),
            $description = __('Event deleted successfully.')
        );
    }

    public function render()
    {
        $events = Event::where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('start_date', 'desc')
                        ->paginate(10);
                        
        return view('livewire.admin.event-manager', ['events' => $events]);
    }
}