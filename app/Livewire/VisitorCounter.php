<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VisitorCounter as VisitorCounterModel;

class VisitorCounter extends Component
{
    public function render()
    {
        $counter = VisitorCounterModel::first();
        $count = $counter ? $counter->count : 0;
        
        return view('livewire.visitor-counter', [
            'count' => $count
        ]);
    }
}
