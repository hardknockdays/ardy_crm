<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects')->delete();
        
        \DB::table('projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'lead_id' => 1,
                'sales_id' => 1,
                'status' => 'waiting_approval',
                'created_at' => '2025-09-05 06:48:12',
                'updated_at' => '2025-09-05 06:48:12',
            ),
            1 => 
            array (
                'id' => 2,
                'lead_id' => 2,
                'sales_id' => 1,
                'status' => 'approved',
                'created_at' => '2025-09-05 06:48:12',
                'updated_at' => '2025-09-05 06:48:12',
            ),
            2 => 
            array (
                'id' => 3,
                'lead_id' => 3,
                'sales_id' => 2,
                'status' => 'ongoing',
                'created_at' => '2025-09-05 06:48:12',
                'updated_at' => '2025-09-05 06:48:12',
            ),
        ));
        
        
    }
}