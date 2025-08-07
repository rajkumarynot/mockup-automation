<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('order_automations', function (Blueprint $table) {
        $table->id();
        $table->string('order_id')->unique();
        $table->string('pdf_path')->nullable();
        $table->string('html_path')->nullable();
        $table->json('shopify_data')->nullable();
        $table->boolean('mail_sent')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_automations');
    }
};
