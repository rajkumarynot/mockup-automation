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
    Schema::table('order_automations', function (Blueprint $table) {
        $table->string('response')->nullable();  // Only add this if not exists
        // Remove or comment out $table->text('response_note')->nullable();
    });
}

public function down()
{
    Schema::table('order_automations', function (Blueprint $table) {
        $table->dropColumn('response');
        // Remove or comment out dropping 'response_note'
    });
}


};
