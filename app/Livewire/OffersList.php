<?php

namespace App\Livewire;

use App\Models\Offer;
use App\Models\offre;
use Livewire\Component;

class OffersList extends Component
{
    protected $listeners = ['jobOfferCreated' => 'refreshOffers'];

    public $offers;

    public function mount()
    {
        $this->offers = offre::latest()->get();
    }

    public function refreshOffers()
    {
        $this->offers =offre::latest()->get();
    }

    public function render()
    {
        return view('livewire.offers-list', [
            'offers' => $this->offers,
        ]);
    }
}
