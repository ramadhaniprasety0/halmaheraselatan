<?php

namespace App\Livewire;
use App\Models\VisitorReview;
use Livewire\Component;

class SubmitReview extends Component
{
    public $name = '';
    public $rating = 5;
    public $comment = '';
    public $success = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();
        VisitorReview::create([
            'name' => $this->name,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'is_approved' => false
        ]);
        $this->success = true;
        $this->reset(['name', 'rating', 'comment']);
    }

    public function render()
    {
        return view('livewire.submit-review');
    }
}
