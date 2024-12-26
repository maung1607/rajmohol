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
        Schema::create('room_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_class_id');
            $table->string('room_number');
            $table->enum('room_type', ['Single','Double', 'Suite']);
            $table->string('description');
            $table->enum('status',['Available','Occopeid','Maintenance'])->default('Available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_infos');
    }
};
