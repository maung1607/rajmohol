<?php

namespace Database\Seeders;

use App\Models\RoomClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomClass::factory()->count(10)->create();
    }
}
