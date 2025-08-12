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
        $table->string('sender_email')->nullable()->after('customer_email');
    });
}

public function down()
{
    Schema::table('order_automations', function (Blueprint $table) {
        $table->dropColumn('sender_email');
    });
}

};
