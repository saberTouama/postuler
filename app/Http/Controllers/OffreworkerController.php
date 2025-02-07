<?php

namespace App\Http\Controllers;

use App\Models\offreworker;
use Illuminate\Http\Request;

class OffreworkerController extends Controller
{
    public function store(Request $request){
    $work_offre= new offreworker();
    $work_offre->offre_id = 88;
    $work_offre->worker_id = 18;
    $work_offre->save();
}
}