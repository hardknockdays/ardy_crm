<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'lead_id' => 2,
                'sales_id' => 2,
                'name' => 'CV Sentosa Prima',
                'contact' => '021-7654321',
                'address' => 'Jl. Gatot Subroto No.5, Jakarta',
                'created_at' => '2025-09-05 06:48:21',
                'updated_at' => '2025-09-06 08:05:03',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'lead_id' => 3,
                'sales_id' => 1,
                'name' => 'UD Makmur Jaya',
                'contact' => '021-5551111',
                'address' => 'Jl. Diponegoro No.10, Bandung',
                'created_at' => '2025-09-05 06:48:21',
                'updated_at' => '2025-09-06 08:05:03',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'lead_id' => 1,
                'sales_id' => 3,
                'name' => 'PT Maju Jaya',
                'contact' => '021-1234567',
                'address' => 'Jl. Sudirman No.1, Jakarta',
                'created_at' => '2025-09-06 01:05:19',
                'updated_at' => '2025-09-06 01:05:19',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
        ));
        
        
    }
}