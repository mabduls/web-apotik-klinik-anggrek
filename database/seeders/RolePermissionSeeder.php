<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $OwnerRole = Role::create([
            'name' => 'owner',
        ]);

        $user = Role::create([
            'name' => 'customers',
        ]);

        $superAdmin = User::create([
            'name' => 'Dr.Sinta Pemilik',
            'email' => 'sinta@owner.com',
            'password' => bcrypt('12345678'),
        ]);

        $superAdmin->assignRole($OwnerRole);
    }
}
