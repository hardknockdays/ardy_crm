<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Budi Sales',
                'email' => 'budi.sales@ptsmart.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$8nrGUibRtxiLb08rVo.n7.GRR2TVshp7AxdOa9Xj2mq6T7F71H9zS',
                'role' => 'sales',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2025-09-05 11:13:20',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sinta Sales',
                'email' => 'sinta.sales@ptsmart.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$wdAfjmu7vOkRo/f0F8weHuvJ3sBAJWaiQhmRWVxJjBqfB/PftUlpS',
                'role' => 'sales',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2025-09-05 11:13:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Rudi Manager',
                'email' => 'rudi.manager@ptsmart.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$DFvPPpQvlYqPGuVJ8MhFFe2rtJ8ztv3p6QYSJHj3rwzzQdsdssnd.',
                'role' => 'manager',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2025-09-05 11:13:21',
            ),
        ));
        
        
    }
}