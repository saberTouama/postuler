<?php 
namespace App\HLivewire;


use App\Models\offre;
use Livewire\Component;
use App\Events\JobOfferCreated;

class PublishOfferForm extends Component
{
    public $titre;
    public $company;
    public $lieu;

    
  

    public function submit()
    {
    //    $this->validate();
       $offer=new Offre();
        
         $offer->save();

        // Save the offer to the database
       
        JobOfferCreated::dispatch($offer);
        // Notify other components
    //    $this->emit('JobOfferCreated', $offer);

        // Reset form
     //   $this->reset(['titre', 'company', 'lieu']);
        session()->flash('success', 'Offer published successfully!');
    }

    public function render()
    {
        return view('livewire.publish-offer-form');
    }
}
