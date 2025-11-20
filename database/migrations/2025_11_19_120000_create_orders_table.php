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
            $table->foreignId('product_id')
                ->constrained('products');
            $table->string('support_person');
            $table->foreignId('customer_unit_id')
                ->constrained('customer_units')
                ->onDelete('cascade');
            $table->date('date');
            $table->integer('qty');
            $table->string('status');
            $table->text('remark')
                ->nullable();
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
