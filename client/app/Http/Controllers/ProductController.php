<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        $menus = Menu::all(); 
        return view('menu', compact('menus'));
    }

    public function show($id)
    {
       
        $menuItem = Menu::where('id_menu', $id)->first();  
    
       
        if ($menuItem) {
            return response()->json($menuItem);
        }
    
        return response()->json(['error' => 'Menu item not found'], 404);
    }

    public function getJoinedStocks()
    {
        $stocks = DB::table('types')
            ->join('stocks', 'stocks.id_type', '=', 'types.id_type')
            ->join('catstocks', 'stocks.id_stock', '=', 'catstocks.id_stock')
            ->join('categories', 'catstocks.id_categorie', '=', 'categories.id_categorie')
            ->select('stocks.*', 'categories.categorie','types.type')
            ->where('stocks.status', 1) 
            ->get();
    
        return response()->json($stocks);
    }
    
    
}

