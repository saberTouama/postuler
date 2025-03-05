<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'name' =>'required|unique:categories,name|max:255',

        ]);

        $category = new category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->back()->with('success','Category added successfully');
    }
}
