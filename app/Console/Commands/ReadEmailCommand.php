<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ShopifyService;
use App\Models\OrderAutomation; // <--- ADD THIS
use App\Mail\MockupPreviewMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerMockupMail;

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
                        $html = view('html_templates.order_template', [
                            'order_id' => $orderId,
                            'data'     => $data['order'] ?? $data
                        ])->render();

                        $htmlPath = storage_path("app/html/{$orderId}.html");
                        file_put_contents($htmlPath, $html);

                        OrderAutomation::updateOrCreate(
                            ['order_id' => $orderId],
                            [
                                'pdf_path'      => $filePath,
                                'shopify_data'  => $data,
                                'html_path'     => $htmlPath
                            ]
                        );
                    }

                    $customerEmail = $data['order']['email'] ?? null;

                    if ($customerEmail) {
                        $previewUrl = url("/html/preview/{$orderId}");

                        Mail::to($customerEmail)->send(new MockupPreviewMail($orderId, $previewUrl, $customerName));

                        OrderAutomation::updateOrCreate(
                            ['order_id' => $orderId],
                            ['mail_sent' => true]
                        );

                        $this->info("✅ Sent email to customer: {$customerEmail}");
                    } else {
                        $this->warn("⚠️  No customer email found for Order: {$orderId}");
                    }


                    $this->info("Processed Order: " . $orderId);
                }
            }

            $message->setFlag(['Seen']);
        }

        $this->info("Command executed successfully.");
    }
}
