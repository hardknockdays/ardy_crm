<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeadsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('leads')->delete();
        
        \DB::table('leads')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sales_id' => 1,
                'name' => 'PT Maju Jaya',
                'contact' => '021-1234567',
                'address' => 'Jl. Sudirman No.1, Jakarta',
                'needs' => 'Internet dedicated 100Mbps',
                'status' => 'new',
                'created_at' => '2025-09-05 06:48:10',
                'updated_at' => '2025-09-05 06:48:10',
            ),
            1 => 
            array (
                'id' => 2,
                'sales_id' => 1,
                'name' => 'CV Sentosa',
                'contact' => '021-7654321',
                'address' => 'Jl. Gatot Subroto No.5, Jakarta',
                'needs' => 'Internet 50Mbps',
                'status' => 'contacted',
                'created_at' => '2025-09-05 06:48:10',
                'updated_at' => '2025-09-05 06:48:10',
            ),
            2 => 
            array (
                'id' => 3,
                'sales_id' => 2,
                'name' => 'UD Makmur',
                'contact' => '021-5551111',
                'address' => 'Jl. Diponegoro No.10, Bandung',
                'needs' => 'Internet 200Mbps',
                'status' => 'qualified',
                'created_at' => '2025-09-05 06:48:10',
                'updated_at' => '2025-09-05 06:48:10',
            ),
        ));
        
        
    }
}