<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->foreignId('user_id')->constrained();
            $table->text('address');
            $table->decimal('discount', 8, 2);
            $table->decimal('delivery_charge', 8, 2);
            $table->decimal('subtotal', 8, 2);
            $table->decimal('grand_total', 8, 2);
            $table->integer('product_qty');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->dateTime('payment_approve_date')->nullable();
            $table->string('transection_id')->nullable();
            $table->json('coupon_info')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('order_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
