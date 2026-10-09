<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck; 

class TruckController extends Controller
{
   
    public function availableTrucks()
    {
        $trucks = Truck::whereIn('status', [1])
                        ->select( 'localisation', 'status','id_truck')
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $trucks
        ]);
    }
}