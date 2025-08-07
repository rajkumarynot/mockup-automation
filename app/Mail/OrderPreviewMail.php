<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPreviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

   public function build()
{
    return $this->subject("Mockup Preview for Order #{$this->order->order_id}")
                ->view('emails.order_preview')
                ->with([
                    'order' => $this->order,
                    'previewUrl' => url("/html/preview/{$this->order->order_id}")
                ]);
}
}
