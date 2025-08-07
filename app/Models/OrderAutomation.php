<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAutomation extends Model
{
    protected $fillable = [
        'order_id',
        'pdf_path',
        'html_path',
        'shopify_data',
        'mail_sent',
    ];
}
