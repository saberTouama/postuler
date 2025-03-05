<?php
namespace App\Livewire;

use App\Models\Chirp;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Chirps extends Component
{
    public $message,$offer_id;

    protected $rules = [
        'message' => 'required|string|max:255',
        //'offer_id'=>'required',
    ];

    public function render()
    {
        $offreId = session('offre_id');


        $chirps = Chirp::where('offer_id', $offreId)->latest()->get();
        return view('livewire.chirps', compact('chirps'));
    }

    public function save()
    {
        $this->validate();

        Chirp::create([
            'message' => $this->message,
            'user_id'=>Auth::user()->id,
             'offer_id'=>session('offre_id'),
        ]);

        $this->reset('message');
    }
}
