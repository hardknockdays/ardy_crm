<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('project_product')->delete();
        
        \DB::table('project_product')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 4,
                'product_id' => 4,
                'harga_jual' => '2300000.00',
                'harga_nego' => '100000.00',
                'created_at' => '2025-09-05 23:49:27',
                'updated_at' => '2025-09-05 23:49:27',
            ),
            1 => 
            array (
                'id' => 2,
                'project_id' => 4,
                'product_id' => 2,
                'harga_jual' => '375000.00',
                'harga_nego' => '2000.00',
                'created_at' => '2025-09-05 23:49:27',
                'updated_at' => '2025-09-05 23:49:27',
            ),
        ));
        
        
    }
}