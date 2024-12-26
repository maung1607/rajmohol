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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('payment_id')->nullable();
            $table->bigInteger('creator_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('adults')->nullable();
            $table->integer('children')->nullable();
            $table->enum('status',['Pending','Confirmed','Cancelled','Completed'])->default('Pending');
            $table->integer('day_range')->default(1);
            $table->text('special_request')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
