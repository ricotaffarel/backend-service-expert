<?php

namespace Database\Seeders;

use App\Models\roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            "id" => 1,
            "name" => "ADMIN"
        ]);

        Roles::create([
            "id" => 2,
            "name" => "MITRA"
        ]);

        Roles::create([
            "id" => 3,
            "name" => "PEGAWAI"
        ]);

        Roles::create([
            "id" => 4,
            "name" => "CUSTOMER"
        ]);

        User::create([
            "id" => 1,
            "name" => "Rikoh",
            "email" => "rikoh@gmail.com",
            "password" => Hash::make("admin"),
            "gender" => "Pria",
            "status_user" => "Aktif",
            "roles_id" => 1,
        ]);

        User::create([
            "id" => 2,
            "name" => "Sri",
            "email" => "sri@gmail.com",
            "password" => Hash::make("mitra"),
            "gender" => "Wanita",
            "status_user" => "Aktif",
            "roles_id" => 2,
        ]);

        User::create([
            "id" => 3,
            "name" => "Bril",
            "email" => "Bril@gmail.com",
            "password" => Hash::make("pegawai"),
            "gender" => "Pria",
            "status_user" => "Aktif",
            "roles_id" => 3,
        ]);

        User::create([
            "id" => 4,
            "name" => "customer1",
            "email" => "customer1@gmail.com",
            "password" => Hash::make("customer"),
            "gender" => "Pria",
            "status_user" => "Aktif",
            "roles_id" => 4,
        ]);
    }
}
