<?php

namespace App\Http\Controllers;

use App\Models\tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    
    public function store( Request $request){

        $request->validate([
            'name' =>'required|unique:tools,name|max:255',
           
        ]);
        $Path = $request->file('path')->store('tools', 'public');
        $tool = new tool();
        $tool->name = $request->name;
        $tool->path = $Path;
        $tool->save();
        return redirect()->back()->with('success','Tool added successfully');
    }
    public function destroy($id){
        $tool=tool::find($id);
        if($tool->path){ 
            Storage::disk('public')->delete($tool->image);
        }
        $tool->delete();
        return redirect()->back()->with('success','Tool removed successfully');
    }

}
