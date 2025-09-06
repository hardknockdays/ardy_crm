<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_product')->delete();
        
        \DB::table('customer_product')->insert(array (
            0 => 
            array (
                'id' => 1,
                'customer_id' => 3,
                'product_id' => 4,
                'harga_nego' => '100000.00',
                'created_at' => '2025-09-06 01:05:19',
                'updated_at' => '2025-09-06 01:05:19',
            ),
            1 => 
            array (
                'id' => 2,
                'customer_id' => 3,
                'product_id' => 2,
                'harga_nego' => '2000.00',
                'created_at' => '2025-09-06 01:05:19',
                'updated_at' => '2025-09-06 01:05:19',
            ),
        ));
        
        
    }
}