<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TypepaymentController extends Controller
{
    public function createOrderCash(Request $request)
    {
        return $this->createOrder($request, 'cash');
    }

    public function createOrderCard(Request $request)
    {
        return $this->createOrder($request, 'card');
    }

    // public function createOrderWithPoints(Request $request)
    // {
    //     $client = Auth::user(); // Get the authenticated client

    //     if (!$client) {
    //         return response()->json(['success' => false, 'message' => 'Client not authenticated.'], 401);
    //     }

    //     $cartItems = Cart::where('id_client', $client->id_client)->get();

    //     if ($cartItems->isEmpty()) {
    //         return response()->json(['success' => false, 'message' => 'Cart is empty.'], 400);
    //     }

    //     $pointsNeeded = $cartItems->sum(fn($item) => $item->quantite * 100); // Example: 100 pts per item

    //     if ($client->points < $pointsNeeded) {
    //         return response()->json(['success' => false, 'message' => 'Not enough points.'], 400);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         foreach ($cartItems as $item) {
    //             Order::create([
    //                 'date_order' => now(),
    //                 'paiement_type' => 'points',
    //                 'quantity' => $item->quantite,
    //                 'id_menu' => $item->id_menu,
    //                 'id_client' => $client->id_client,
    //                 'id_truck' => $request->id_truck,
    //             ]);
    //         }

    //         $client->points -= $pointsNeeded;
    //         $client->save();

    //         Cart::where('id_client', $client->id_client)->delete();

    //         DB::commit();
    //         return response()->json(['success' => true, 'message' => 'Order placed with points.']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['success' => false, 'message' => 'Error processing order.', 'error' => $e->getMessage()], 500);
    //     }
    // }

    private function createOrder(Request $request, string $paymentType)
    {
        $client = Auth::user(); 

        if (!$client) {
            return response()->json(['success' => false, 'message' => 'Client not authenticated.'], 401);
        }

        $cartItems = Cart::where('id_client', $client->id_client)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty.'], 400);
        }

        DB::beginTransaction();
        //Log::info("$paymentType -- $item->quantite  --$item->id_menu--$client->id_client--$request->id_truck");
        try {
            foreach ($cartItems as $item) {
                $f=fopen("log.txt",'w');
                fputs($f,"$paymentType -- $item->quantite  --$item->id_menu--$client->id_client--$request->id_truck");
                fclose($f);

                Order::create([
                    'date_order' => now(),
                    'paiement_type' => $paymentType,
                    'quantity' => $item->quantite,
                    'id_menu' => $item->id_menu,
                    'id_client' => $client->id_client,
                    'id_truck' => $request->id_truck,
                ]);
            }

            Cart::where('id_client', $client->id_client)->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => "Order placed with {$paymentType}."]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error processing order.', 'error' => $e->getMessage()], 500);
        }
    }
}
