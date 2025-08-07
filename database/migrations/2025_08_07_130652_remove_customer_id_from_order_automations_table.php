<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCustomerIdFromOrderAutomationsTable extends Migration
{
    public function up()
    {
        Schema::table('order_automations', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['customer_id']);
            // Then drop the column
            $table->dropColumn('customer_id');
        });
    }

    public function down()
    {
        Schema::table('order_automations', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }
}
