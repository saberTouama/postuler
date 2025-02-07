<?php 
namespace App\Livewire;


use App\Models\offre;
use Livewire\Component;
use App\Events\JobOfferCreated;

class Mondy extends Component
{
    public $titre;
    public $company;
    public $lieu;
public $offers;
    
  



public function submit()
{
  

    offre::create([
        'titre' => $this->titre,
        'company' => $this->company,
        'lieu' => $this->lieu,
    ]);

    $this->reset(['titre', 'company', 'lieu']);
}


    public function render()
    {
//send $offers to the view
return view('livewire.mondy', [
    'offers' => offre::all(), // Pass offers to the view
]);
    }
}
