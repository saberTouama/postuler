<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Candidates extends Component
{
    public function render()
    {
        $workers = DB::table('workers')->get();


        return view('livewire.candidates',compact('workers'));
    }
}
