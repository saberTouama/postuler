<?php 
namespace App\Livewire;

use App\Models\Offer;
use App\Models\offre;
use Livewire\Component;
use Livewire\Attributes\On;

class OfferList extends Component
{
    public $offers = [];

    protected $listeners = ['JobOfferCreated' => 'refreshOffers'];

    public function mount()
    {
        $this->refreshOffers();
    }
   // #[On('echo:my-channel,JobOfferCreated')]
    public function refreshOffers()
    {
        $this->offers = offre::latest()->get();
    }

    public function render()
    {
        return view('livewire.offer-list', ['offers' => $this->offers]);
    }
}
