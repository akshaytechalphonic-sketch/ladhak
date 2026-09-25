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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20);

            $table->string('postal_code')->nullable();
            $table->text('address')->nullable();

            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('INR');

            $table->text('package_details')->nullable();

            $table->string('razorpay_order_id')->unique();
            $table->string('razorpay_payment_id')->unique();
            $table->string('razorpay_signature');

            $table->string('payment_status')->default('Paid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
