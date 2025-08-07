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

    public function preview($orderId)
    {
        $order = OrderAutomation::where('order_id', $orderId)->firstOrFail();
        $data = $order->shopify_data;
        
        // return view('html.preview', ['order_id' => $order_id]);
        return view('html_templates.order_template', compact('data'));
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
        $customerEmail = $order->shopify_data['email'] ?? 'rajkumar@y-not.com';
        $previewUrl = url('/html/preview/' . $order_id);

        \Mail::raw("Hello Customer,\n\nYour mockup for Order #$order_id is ready.\nPreview it here: $previewUrl\n\nRegards,\nY-Not Team", function ($message) use ($customerEmail) {
            $message->to($customerEmail)
                    ->subject('Mockup Preview');
        });

        // Mark as sent
        $order->email_sent = true;
        $order->save();

        \Log::info("✅ Mail sent to $customerEmail for Order ID: $order_id");

        return redirect()->back()->with('success', "✅ Mail sent to $customerEmail");
    } catch (\Exception $e) {
        \Log::error("❌ Mail failed: " . $e->getMessage());
        return redirect()->back()->with('error', '❌ Failed to send email: ' . $e->getMessage());
    }
}

}
