<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAutomation extends Model
{
   protected $fillable = [
    'order_id',
    'pdf_path',
    'shopify_data',
    'html_path',
    'mail_sent',
    'customer_name',
    'customer_email'
];

}
