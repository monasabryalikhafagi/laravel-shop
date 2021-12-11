<?php

namespace Modules\Orders\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\Payment;

class OrdersApiController extends Controller
{

    public function AddOrder(Request $request)
    {
       
        try {
            $data = $request->all();

            $productId = Arr::pull($data, 'product_id', null);
            $quantity = Arr::pull($data, 'quantity', null);
            $data['user_id'] = Auth::user() ? Auth::user()->id : null;
            $created = Order::create(['quantity'=>$quantity]);

            if ($created) {
                $created->products()->attach($productId);
            }
            $paymentAttributes = [
                'item_number' => $productId,
                'transaction_id' => $data["transaction_id"],
                'payment_status' => $data["status"],
                'currency_code' => 'USD',

            ];

            $payment = Payment::create($paymentAttributes);
            return response()->json(["message" => "Order created successfully"], 200);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Order creation Failed!', "error" => $e], 409);
        }

    }

}
