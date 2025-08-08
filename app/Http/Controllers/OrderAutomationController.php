<?php
namespace App\Http\Controllers;

use App\Models\OrderAutomation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPreviewMail;
use Illuminate\Support\Facades\Log;

class OrderAutomationController extends Controller
{
    public function index()
    {
        $orders = OrderAutomation::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function preview($order_id)
{
    $order = OrderAutomation::where('order_id', $order_id)->first();

    if (!$order) {
        abort(404, 'Order not found');
    }
    
    $previewUrl = url('/html/preview/' . $order_id);
    $customerName = $order->customer_name ?? 'Customer';

    return view('html_templates.order_template', [
        'order' => $order,
        'order_id' => $order_id,
        'previewUrl' => $previewUrl,
        'customerName' => $customerName,
    ]);
}



    
    public function sendMail($orderId)
    {
        $order = \App\Models\OrderAutomation::where('order_id', $orderId)->firstOrFail();

        $customerEmail = $order->shopify_data['email'] ?? null;

        if (!$customerEmail) {
            return redirect()->route('orders.index')->with('error', 'No customer email found.');
        }

        // Send the mail
        Mail::to($customerEmail)->send(new OrderPreviewMail($order->order_id));

        // Mark as sent
        $order->email_sent = true;
        $order->save();

        return redirect()->route('orders.index')->with('success', "Preview mail sent to {$customerEmail}");
    }



 public function sendPreviewEmail($order_id)
{
    $order = OrderAutomation::where('order_id', $order_id)->first();

    if (!$order) {
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }

    try {
        $shopifyData = $order->shopify_data;
        $customerEmail = $order->customer_email; // 📥 Direct from DB

        if (!$customerEmail) {
            return redirect()->back()->with('error', '❌ Customer email not found in order data.');
        }


        $previewUrl = url('/html/preview/' . $order_id);

        \Mail::send('emails.mockup_ready', [
            'order' => $order,
            'orderId' => $order->order_id,
            'customerName' => $order->customer_name,
            'previewUrl' => $previewUrl, // ✅ add this
        ], function ($message) use ($customerEmail, $order_id) {
            $message->to($customerEmail)
                    ->subject("Mockup Ready - Order #$order_id");
        });



        $order->email_sent = true;
        $order->save();

        \Log::info("✅ Mail sent", [
            'email' => $customerEmail,
            'order_id' => $order_id
        ]);

        return redirect()->back()->with('success', "✅ Mail sent to $customerEmail");
    } catch (\Exception $e) {
        \Log::error("❌ Mail failed: " . $e->getMessage());
        return redirect()->back()->with('error', '❌ Failed to send email: ' . $e->getMessage());
    }
}



}
