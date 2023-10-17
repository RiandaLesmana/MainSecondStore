<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nores;

class NoresController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'resi' => 'required'
        ]);
    
        // Create a new record in the 'nores' table
        $nores = new Nores();
        $nores->name = $request->name;
        $nores->resi = $request->resi;
        $nores->save();
    
        // Redirect or perform any additional actions as needed
        return redirect()->back()->with('success', 'Data stored successfully.')->with('nores', $nores);
    }
    

}
