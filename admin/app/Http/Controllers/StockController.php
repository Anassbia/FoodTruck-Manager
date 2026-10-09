<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Catstock;
use App\Models\Categorie;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{

    public function showStock(){
        $categorie = Categorie::all();
        $types = Type::all();


        //return view('list_employees', compact('roles', 'jobs'));
        return response()->json(['html' => view('list_product', compact('categorie','types'))->render()]);
    }


    public function index()
    {
        $stocks = Stock::join('types', 'stocks.id_type', '=', 'types.id_type')
            ->select(
                'stocks.*',
                'types.type as type'
            )
            ->get();
    
        return response()->json([
            'status' => 'success',
            'data' => $stocks
        ]);
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'id_type' => 'required|exists:types,id_type',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'categories' => 'required|array', // Ensure categories is an array
            'categories.*' => 'exists:categories,id_categorie'  // Ensure each category id exists in the categories table
        ]);
    
        // Handle image upload if it exists
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('stocks', 'public');
            $validated['image'] = $path;
        }
    
        // Create the stock record and get the ID of the created stock
        $stock = Stock::create($validated);
        // Check if stock creation is successful
        if (!$stock) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create stock record.'
            ], 500);
        }
    
        // Insert multiple rows into the Catstock table for each category
        $categories = $request->input('categories');  // Get the categories array from the request
        
        foreach ($categories as $categoryId) {
            Catstock::create([
                'id_stock' => $stock->id_stock,
                'id_categorie' => (int) $categoryId, 
            ]);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data received and stock with categories created successfully!',
            'data' => $stock,
        ]);
    }
    

    


    public function update(Request $request, $id)
    {
        // Validate the input fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'quantity' => 'required|integer',
            'status' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',  // Add image validation
        ]);
    
        // Find the stock item by its ID
        $stock = Stock::findOrFail($id);
    
        // Check if an image file is uploaded
        if ($request->hasFile('image')) {
            // If there is an existing image, delete it from the storage
            if ($stock->image && Storage::exists($stock->image)) {
                Storage::delete($stock->image);
            }
    
            // Store the new image in the 'stocks' directory within the public disk
            $path = $request->file('image')->store('stocks', 'public');
    
            // Add the image path to the validated data
            $validated['image'] = $path;
        }
    
        // Update the stock item with the validated data
        $stock->update($validated);
    
        return response()->json(['status' => 'success']);
    }
    

    public function destroy($id)
    {
        Stock::findOrFail($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully']);
    }
}
