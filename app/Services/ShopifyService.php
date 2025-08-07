<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShopifyService
{
    public function getOrder($orderId)
    {
        $shopName = config('app.shopify_store');
        $token = config('app.shopify_access_token');

        $url = "https://{$shopName}/admin/api/2023-10/orders/{$orderId}.json";


        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $token
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }
}
