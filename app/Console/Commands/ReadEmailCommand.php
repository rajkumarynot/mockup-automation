<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ShopifyService;
use App\Models\OrderAutomation; // <--- ADD THIS
use App\Mail\MockupPreviewMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerMockupMail;
use App\Models\Customer;

class ReadEmailCommand extends Command
{
    protected $signature = 'read:emails';
    protected $description = 'Read inbox and process PDF orders';

    public function handle()
    {
        $client = \Webklex\IMAP\Facades\Client::account('gmail');
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->unseen()->get();

        foreach ($messages as $message) {
            $subject = $message->getSubject();
            preg_match('/#(\d+)/', $subject, $matches);
            $orderId = $matches[1] ?? null;

            if (!$orderId) continue;

            foreach ($message->getAttachments() as $attachment) {
                if ($attachment->getExtension() === 'pdf') {
                    $filePath = storage_path("app/public/pdfs/{$orderId}.pdf");
                    $attachment->save(storage_path('app/public/pdfs/'), "{$orderId}.pdf");


                    OrderAutomation::updateOrCreate(
                        ['order_id' => $orderId],
                        ['pdf_path' => $filePath]
                    );

                    $shopify = new ShopifyService();
                    $data = $shopify->getOrder($orderId);
                   $customerEmail = $data['customer']['email'] ?? null;
                   $customer = $data['customer'] ?? null;

                    $customerName = 'Customer';
                    if ($customer) {
                        $first = $customer['first_name'] ?? '';
                        $last = $customer['last_name'] ?? '';
                        $fullName = trim($first . ' ' . $last);
                        if ($fullName !== '') {
                            $customerName = $fullName;
                        }
                    }
                    info("Customer Name: " . $customerName);

                    if ($data) {
                        // ---- STEP 5: HTML CREATION ----
                        $order = OrderAutomation::where('order_id', $orderId)->first();

                    $html = view('html_templates.order_template', [
                        'order_id'     => $orderId,
                        'data'         => $data['order'] ?? $data,
                        'customerName' => $order->customer_name ?? 'Customer',
                        'order'        => $order
                    ])->render();

                        $htmlPath = storage_path("app/html/{$orderId}.html");
                        file_put_contents($htmlPath, $html);

                        $senderEmail = $message->getFrom()[0]->mail ?? null; // actual sender email of the reply

                        OrderAutomation::updateOrCreate(
                            ['order_id' => $orderId],
                            [
                                'pdf_path'      => $filePath,
                                'shopify_data'  => $data,
                                'html_path'     => $htmlPath,
                                'sender_email' => $senderEmail,
                            ]
                        );
                    }

                   $customerEmail = $data['order']['email'] ?? null;

                    $customerName = 'Customer';
                    $first = $data['order']['customer']['first_name'] ?? '';
                    $last = $data['order']['customer']['last_name'] ?? '';
                    $fullName = trim("$first $last");
                    if ($fullName !== '') {
                        $customerName = $fullName;
                    }

                    if ($customerEmail) {
                        $previewUrl = url("/html/preview/{$orderId}");



                        // Automatic mail will send to customer code start here


                        // Mail::to($customerEmail)->send(new MockupPreviewMail($orderId, $previewUrl, $customerName));

                        OrderAutomation::updateOrCreate(
                            ['order_id' => $orderId],
                            [
                                'mail_sent'       => false,
                                'customer_name'   => $customerName,
                                'customer_email'  => $customerEmail,
                            ]
                        );

                        $this->info("✅ Sent email to customer: {$customerEmail}");
                        $this->info("✅ Customer info stored in order_automations: {$customerName} ({$customerEmail})");
                        
                        
                        // Automatic mail will send to customer code end here



                } else {
                    $this->warn("⚠️  No customer email found for Order: {$orderId}");
}



                    $this->info("Processed Order: " . $orderId);
                }
            }

            $message->setFlag(['Seen']);
            $shopifyEmail = $data['order']['email'] ?? null;
$shopifyName = trim(($data['order']['customer']['first_name'] ?? '') . ' ' . ($data['order']['customer']['last_name'] ?? ''));

if ($shopifyEmail) {
    $customer = \App\Models\Customer::firstOrCreate(
        ['email' => $shopifyEmail],
        ['name' => $shopifyName]
    );
    $this->info("✅ Customer stored: {$shopifyName} ({$shopifyEmail})");
}

        }

        $this->info("Command executed successfully.");
    }
}
