<?php

namespace App\Http\Controllers;

use App\Models\email;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class EmailController2 extends Controller
{
    
    public function store(Request $request): RedirectResponse{
 $Email=new email();
  $Email->email=$request->email;
  $Email->save();
 return redirect()->back();
  
    }
}
