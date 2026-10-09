<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::all();

        return response()->json([
            'status' => 'success',
            'data' => $trucks
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule' => 'required|string|unique:trucks,matricule',
            'type' => 'required|string',
            'password' => 'required|string',
            'localisation' => 'required|string',
        ]);

        $truck = Truck::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Data received successfully!'
        ]);    }



    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'matricule' => 'required|string|unique:trucks,matricule,'. $id . ',id_truck',
            'type' => 'required|string',
            'password' => 'required|string',
            'localisation' => 'required|string',
            'status' => 'required|numeric'
        ]);

        Truck::findOrFail($id)->update($validated);
        return response()->json(['status' => 'success', 'data' => $request->all()]);
    }

    public function destroy($id)
    {
        Truck::findOrFail($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully']);
    }
}
