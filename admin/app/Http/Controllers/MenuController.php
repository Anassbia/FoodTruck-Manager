<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::all();

        return response()->json([
            'status' => 'success',
            'data' => $menus
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'reduction' => 'nullable|numeric',
        ]);
        
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
            $validated['image'] = $imagePath;
        }

        $menu = Menu::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Data received successfully!'
        ]);    
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'reduction' => 'nullable|numeric',
            'status' => 'required|numeric'
        ]);
    
        $menu = Menu::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($menu->image && Storage::exists($menu->image)) {
                Storage::delete($menu->image);
            }
    
            $path = $request->file('image')->store('menus', 'public');
            $validated['image'] = $path;
        }
    
        $menu->update($validated);
    
        return response()->json(['status' => 'success', 'data' => $menu]);
    }
    

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully']);
    }
}
