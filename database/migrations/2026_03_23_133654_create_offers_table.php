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
        Schema::create('offers', function (Blueprint $col) {
            $col->id();
            $col->string('title');
            $col->text('description');
            $col->string('discount_tag')->nullable();
            $col->decimal('price', 10, 2)->nullable();
            $col->string('image')->nullable();
            $col->boolean('status')->default(true);
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
