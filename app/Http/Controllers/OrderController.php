<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Events\NewOrderEvent;


class OrderController extends Controller
{
    public function create(Request $request)
    {
        // ตรวจสอบข้อมูลที่รับมาจากผู้ใช้
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'shipping_address' => 'required',
            'billing_address' => 'required',
            'product_id' => 'required|exists:products,id',
            'summary_price' => 'required|numeric',
        ]);

        // สร้าง Order
        $order = Order::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address,
            'product_id' => $request->product_id,
            'summary_price' => $request->summary_price,
        ]);

        // ส่ง Event แจ้งเตือนแอดมิน
        event(new NewOrderEvent($order));

        // ส่งการตอบกลับ
        return response()->json(['message' => 'Order created successfully'], 201);
    }
}
