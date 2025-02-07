<?php namespace App\Livewire;

use App\Models\Offer;
use App\Models\offre;
use Livewire\Component;

class Publishing extends Component
{
    public $titre, $company, $lieu, $nb_post;
    public $offers = [];

    public function mount()
    {
        $this->fetchOffers();
    }

    public function fetchOffers()
    {
        $this->offers = offre::latest()->get();
    }

    public function submitJobOffer()
    {
        offre::create([
            'titre' => $this->titre,
            'company' => $this->company,
            'lieu' => $this->lieu,
            'nb_post' => $this->nb_post,
        ]);

        $this->fetchOffers(); // Refresh the offers list
        session()->flash('message', 'Job offer created successfully!');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->company = '';
        $this->lieu = '';
        $this->nb_post = '';
    }

    public function render()
    {
        return view('livewire.publishing');
    }
}
