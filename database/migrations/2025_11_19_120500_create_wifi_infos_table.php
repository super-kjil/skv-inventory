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
        Schema::create('wifi_infos', function (Blueprint $table) {
            $table->id();
            $table->string('ssid');
            $table->string('password');
            $table->foreignId('customer_unit_id')
                ->constrained('customer_units')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->string('mgmt_ip');
            $table->string('wifi_user');
            $table->string('wifi_password');
            $table->string('status');
            $table->string('remark')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wifi_infos');
    }
};
