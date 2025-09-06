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
                'status' => 'ongoing',
                'created_at' => '2025-09-05 06:48:12',
                'updated_at' => '2025-09-05 23:20:27',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'lead_id' => 2,
                'sales_id' => 1,
                'status' => 'approved',
                'created_at' => '2025-09-05 06:48:12',
                'updated_at' => '2025-09-05 06:48:12',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'lead_id' => 3,
                'sales_id' => 2,
                'status' => 'ongoing',
                'created_at' => '2025-09-05 06:48:12',
                'updated_at' => '2025-09-05 06:48:12',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'lead_id' => 1,
                'sales_id' => 3,
                'status' => 'approved',
                'created_at' => '2025-09-05 23:49:27',
                'updated_at' => '2025-09-06 00:32:08',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
        ));
        
        
    }
}