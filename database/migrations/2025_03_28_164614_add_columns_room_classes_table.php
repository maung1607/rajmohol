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
        Schema::table('room_classes', function (Blueprint $table) {
            $table->integer('number_of_beds')->default(1)->after('discount');
            $table->integer('number_of_baths')->default(1)->after('number_of_beds');
            $table->tinyInteger('is_wifi')->default(1)->after('number_of_baths');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_classes', function (Blueprint $table) {
            $table->dropColumn('number_of_beds');
            $table->dropColumn('number_of_baths');
            $table->dropColumn('is_wifi');
        });
    }
};
