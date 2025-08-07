<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MockupPreviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;
    public $previewUrl;
    protected $customerName;

    /**
     * Create a new message instance.
     */
    public function __construct($orderId, $previewUrl, $customerName)
    {
        $this->orderId = $orderId;
        $this->previewUrl = $previewUrl;
        $this->customerName = $customerName;

    }

    /**
     * Build the message.
     */
   public function build()
{
    return $this->subject("Mockup Ready - Order #{$this->orderId}")
                ->view('emails.mockup_ready')
                ->with([
                    'orderId' => $this->orderId,
                    'previewUrl' => url("/html/preview/{$this->orderId}"),
                    'customerName' => $this->customerName

                ]);
}
}
