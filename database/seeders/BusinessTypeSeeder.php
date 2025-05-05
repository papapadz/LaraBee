<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('business_types')->insert([
            'type' => 'Construction',
            'description' => 'Electrical Works and Civil Works',
            'category' => 'Service'
        ]);
    }
}
