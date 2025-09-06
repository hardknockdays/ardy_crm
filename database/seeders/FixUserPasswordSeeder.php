<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FixUserPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $u) {
            // cek apakah password belum di-hash (bcrypt selalu diawali $2y$)
            if (!str_starts_with($u->password, '$2y$')) {
                $u->password = Hash::make($u->password);
                $u->save();

                echo "Updated password for {$u->email}\n";
            }
        }
    }
}
