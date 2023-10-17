<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confirm;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;

class ConfirmController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'jaspeng' => 'required',
            'noresi' => 'required',
            'kode_pemesanan' => 'required',
        ]);
    
        // Create a new record in the 'confirm' table
        $confirm = new Confirm();
        $confirm->jaspeng = $request->jaspeng;
        $confirm->noresi = $request->noresi;
        $confirm->order_id = $request->kode_pemesanan;
        $confirm->save();
    
        // Return a response or perform any additional actions as needed
        return Redirect::route('paidOrder');
    }

    public function show(Confirm $confirm)
    {
        return view('confirm', compact('confirm'));
    }

    public function arrive(Confirm $confirm)
    {
        $confirm->update([
            'is_delivered' => true
        ]);

        return Redirect::back();
    }
}
