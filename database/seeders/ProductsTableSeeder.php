<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Internet 50Mbps',
                'hpp' => '200000.00',
                'margin' => '20.00',
                'price' => '240000.00',
                'created_at' => '2025-09-05 06:48:07',
                'updated_at' => '2025-09-05 06:48:07',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Internet 100Mbps',
                'hpp' => '300000.00',
                'margin' => '25.00',
                'price' => '375000.00',
                'created_at' => '2025-09-05 06:48:07',
                'updated_at' => '2025-09-05 06:48:07',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Internet 200Mbps',
                'hpp' => '500000.00',
                'margin' => '30.00',
                'price' => '650000.00',
                'created_at' => '2025-09-05 06:48:07',
                'updated_at' => '2025-09-05 06:48:07',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Kuota 1TB',
                'hpp' => '2000000.00',
                'margin' => '15.00',
                'price' => '2300000.00',
                'created_at' => '2025-09-05 21:30:50',
                'updated_at' => '2025-09-05 21:33:49',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
        ));
        
        
    }
}