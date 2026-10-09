<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    
    public function getCart()
    {
        
        $clientId = auth()->id();

        
        $listCart = DB::table('carts')
            ->join('menus', 'carts.id_menu', '=', 'menus.id_menu')
            ->select(
                'carts.id_cart',
                'menus.id_menu as id',
                'menus.name',
                'menus.price',
                'menus.image',
                'carts.quantite as quantity'
            )
            ->where('carts.id_client', $clientId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $listCart
        ]);
    }

    public function addToCart(Request $request, $menuId)
    {
        
        $clientId = auth()->id();


        
        $cartItem = Cart::where('id_client', $clientId)
                        ->where('id_menu', $menuId)
                        ->first();

                       

        if ($cartItem) {
          
            $newQuantity = $cartItem->quantite + 1; 

            $cartItem->update([
                'quantite' => $newQuantity,
                'updated_at' => now(),
            ]);
        } else {
            
            Cart::create([
                'quantite'   => 1, 
                'id_client'  => $clientId,
                'id_menu'    => $menuId,
            ]);
        }

       //00btenir l panier mn lutilisateur 
        $listCart = DB::table('carts')
                    ->join('menus', 'carts.id_menu', '=', 'menus.id_menu')
                    ->select(
                        'menus.id_menu as id',
                        'menus.name',
                        'menus.price',
                        'menus.image',
                        'carts.quantite as quantity'
                    )
                    ->where('carts.id_client', $clientId)
                    ->get();

       
        return response()->json([
            'success' => true,
            'data' => $listCart
        ]);
    }

    
    public function updateQuantity(Request $request)
    {
        
        $cartItem = Cart::find($request->input('id_cart'));

       
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found.']);
        }

        
        $cartItem->update([
            'quantite' => $request->input('quantity'),  
            'updated_at' => now(), 
        ]);

        
        return response()->json(['success' => true]);
    }

    
    public function removeItem(Request $request)
    {
        
        $cartItem = Cart::find($request->input('id_cart'));

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        
        $cartItem->delete();

        return response()->json(['success' => true]);
    }
}
