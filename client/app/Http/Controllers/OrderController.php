<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TypepaymentController;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        
        $user = Auth::user(); 

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User is not authenticated.',
            ], 401); 
        }

        
        $validator = Validator::make($request->all(), [
            'paiement_type' => 'required|in:cash,card,points',
            'id_truck' => 'required|exists:trucks,id_truck', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

    
        $paymentHandler = new TypepaymentController();

        switch ($request->paiement_type) {
            case 'cash':
                return $paymentHandler->createOrderCash($request);
            case 'card':
                return $paymentHandler->createOrderCard($request);
            case 'points':
                return $paymentHandler->createOrderWithPoints($request);
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment type.',
                ], 400);
        }
    }
}
