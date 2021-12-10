<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductsAndOrder;

class OrderController extends Controller
{
    public function GetOrders() {
        return Response(Order::all(), 200);
    }

    public function GetOrder($id) {
        $productsAndOrder = ProductsAndOrder::where('order_id', $id)->first();
        return Response([
            $productsAndOrder,
            ProductsAndOrder::where(
                'product_id',
                $productsAndOrder['product_id']
            )->get()
        ]);
    }

    public function AddOrder(Request $request) {
        $order = Order::create($request->all());

        foreach($request->products as $product) {
            ProductsAndOrder::create([
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'count' => $product['count']
            ]);
        }

        return Response('Create success');
    }

    public function UpdateStatus($id) {
        $order = Order::findOrFail($id)->first();

        if ($order['status'] == 'False')
            $order['status'] = 'True';
        else
            $order['status'] = 'False';

        Order::findOrFail($id)->update(['status' => $order['status']]);

        return Response(Order::findOrFail($id));
    }
}
