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
                'name' => 'CV Sentosa',
                'contact' => '021-7654321',
                'address' => 'Jl. Gatot Subroto No.5, Jakarta',
                'created_at' => '2025-09-05 06:48:21',
                'updated_at' => '2025-09-05 06:48:21',
            ),
            1 => 
            array (
                'id' => 2,
                'lead_id' => 3,
                'name' => 'UD Makmur',
                'contact' => '021-5551111',
                'address' => 'Jl. Diponegoro No.10, Bandung',
                'created_at' => '2025-09-05 06:48:21',
                'updated_at' => '2025-09-05 06:48:21',
            ),
        ));
        
        
    }
}