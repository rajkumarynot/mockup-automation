<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Mail\MockupPreviewMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\OrderAutomationController;
use App\Http\Controllers\PreviewController;



// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/html/preview/{orderId}', function ($orderId) {
    $path = storage_path("app/html/{$orderId}.html");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'text/html'
    ]);
});

Route::get('/preview/{orderId}', [PreviewController::class, 'show'])->name('orders.preview');
 
 
 
// Route::get('/test-mail', function () {
//     Mail::to('rjksharma23@email.com')->send(new MockupPreviewMail(12345, url('/html/preview/12345')));
//     return 'Test email sent!';
// });

Route::get('/', [OrderAutomationController::class, 'index'])->name('orders.index');
Route::get('/html/preview/{orderId}', [OrderAutomationController::class, 'preview'])->name('orders.preview');
Route::post('/orders/send-mail/{orderId}', [OrderAutomationController::class, 'sendMail'])->name('orders.sendMail');
// Route::get('/preview/{order_id}', [\App\Http\Controllers\OrderAutomationController::class, 'preview'])->name('orders.preview');
Route::get('/orders/send/{order_id}', [OrderAutomationController::class, 'sendPreviewEmail'])->name('orders.send');
Route::post('/orders/send/{order_id}', [OrderAutomationController::class, 'sendPreviewEmail'])->name('orders.send');
