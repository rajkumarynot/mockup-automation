<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrderAutomation;

class OrderController extends Controller
{
   public function storeCustomerResponse(Request $request, $order_id)
{
    $request->validate([
        'response' => 'nullable|string|max:1000',
        'response_note' => 'nullable|string|max:2000',
        'response_note1' => 'nullable|string|max:2000',
    ]);

    $order = OrderAutomation::where('order_id', $order_id)->first();

    if (!$order) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    $order->customer_response = $request->input('response');
    $order->response_note = $request->input('response_note','response_note1');
    $order->save();

    return redirect()->back()->with('success', '✅ Thank you! Your response has been recorded.');
}

}
