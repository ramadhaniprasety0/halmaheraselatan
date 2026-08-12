<?php

namespace App\Livewire;
use App\Models\VisitorReview;
use Livewire\Component;

class ReviewCarousel extends Component
{
    public function render()
    {
        $reviews = VisitorReview::where('is_approved', true)->latest()->take(10)->get();
        return view('livewire.review-carousel', ['reviews' => $reviews]);
    }
}
