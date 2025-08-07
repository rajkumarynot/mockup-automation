<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\OrderAutomation;
 
class PreviewController extends Controller
{
    public function show($orderId)
    {
        $order = OrderAutomation::where('order_id', $orderId)->first();
 
        if (!$order) {
            return abort(404, "Order not found.");
        }
 
        // Decode the saved Shopify data (stored as JSON)
        $shopifyData = json_decode($order->shopify_data, true);
 
        return view('html_templates.order_template', [
            'order_id' => $orderId,
            'data' => $shopifyData['order'] ?? $shopifyData
        ]);
    }
}
 
 