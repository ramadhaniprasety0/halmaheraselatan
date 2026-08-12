<?php

namespace App\Livewire;
use App\Models\Newsletter;
use Livewire\Component;

class NewsletterForm extends Component
{
    public $email = '';
    public $success = false;

    protected $rules = [
        'email' => 'required|email|unique:newsletters,email',
    ];

    public function subscribe()
    {
        $this->validate();
        Newsletter::create(['email' => $this->email]);
        $this->success = true;
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
