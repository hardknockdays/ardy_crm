<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_services')->delete();
        
        \DB::table('customer_services')->insert(array (
            0 => 
            array (
                'id' => 1,
                'customer_id' => 1,
                'product_id' => 1,
                'start_date' => '2023-01-15',
                'end_date' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-05 06:48:23',
                'updated_at' => '2025-09-05 06:48:23',
            ),
            1 => 
            array (
                'id' => 2,
                'customer_id' => 2,
                'product_id' => 3,
                'start_date' => '2023-02-01',
                'end_date' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-05 06:48:23',
                'updated_at' => '2025-09-05 06:48:23',
            ),
        ));
        
        
    }
}