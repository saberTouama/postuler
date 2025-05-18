<?php

namespace App\Livewire;

use App\Models\worker;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Candidates extends Component
{
    use WithPagination;
    public $deleteDesabled=true;
    public $offer_id;
 public $workerId=0;
 public $showModal=false ;
 public function mount()
{
    if (session()->has('offer_id')) {
        $this->offer_id = session('offer_id');
    }
}
    public function confirmDelete($id)
    {

        $this->workerId = $id;
        $this->deleteDesabled=false;


    }

    public function deleteWorker()
    {
        worker::findOrFail($this->workerId)->delete();

   $this->deleteDesabled=true;

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

        $workers = DB::table('workers')->paginate(10);
   if(!empty($this->offer_id)){
        $workers=worker::where('concernedoffre',$this->offer_id)->paginate(10);
   }

        return view('livewire.candidates',compact('workers'));
    }
}
