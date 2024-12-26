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
            $table->string('payment_number');
            $table->float('actual_amount',10,2)->default(0);
            $table->float('total_amount',10,2)->default(0);
            $table->float('paid_amount',10,2)->default(0);
            $table->float('due_amount',10,2)->default(0);
            $table->integer('discount')->default(0);
            $table->enum('payment_method',['Credit Card','Cash','Online']);
            $table->enum('status',['Pending','Due','Completed','Failed'])->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes();
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
