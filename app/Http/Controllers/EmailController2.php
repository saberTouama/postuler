<?php

namespace App\Http\Controllers;

use App\Models\email;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class EmailController2 extends Controller
{

    public function store(Request $request): RedirectResponse{
        $request->validate([
    'not_email'=>'unique:emails,email']
        );
 $Email=new email();

  $Email->email=$request->not_email;
  $Email->save();
 return redirect()->back();

    }
}
