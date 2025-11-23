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
        Schema::create('customer_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name');
            $table->string('customer_type');
            $table->string('customer_name')
                ->nullable();
            $table->string('customer_id')
                ->nullable();
            $table->string('customer_tel')
                ->nullable();
            $table->string('status');
            $table->string('remark')
                ->nullable();
            $table->foreignId('site_id')
                ->constrained('sites')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_units');
    }
};
