<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dbPath = base_path().'/database';
        $json = File::get($dbPath.'/json/employmentStatus.json');
        $data = json_decode($json);
        foreach ($data as $item) {
        	DB::table('employment_status')->insert([
                'status' => $item,
                'description' =>  '...',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $this->command->info('Employment Status seeded!');
    }
}
