<?php

namespace App\Livewire;

use App\Models\worker;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Candidates extends Component
{
    public $offer_id;
 public $workerId=0;
 public $showModal=false ;
    public function confirmDelete($id)
    {

        $this->workerId = $id;

        $this->showModal = true;
    }

    public function deleteWorker()
    {  dd( $this->workerId );
        worker::findOrFail($this->workerId)->delete();



        // Optional: Show flash message
        session()->flash('message', 'Worker deleted successfully!');
    }
    public function markAsFiltered($workerId){
        $condidat=worker::find( $workerId);
        $condidat->status='filtred';
        $condidat->save();
        return redirect()->back();
    }
    public function render()
    {
        if (session('offer_id')){ $this->offer_id=session('offer_id');}
        $workers = DB::table('workers')->get();
   if(!empty($this->offer_id)){
        $workers=worker::where('concernedoffre',session('offer_id'))->get();
   }

        return view('livewire.candidates',compact('workers'));
    }
}
