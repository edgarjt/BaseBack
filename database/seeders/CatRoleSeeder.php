<?php

namespace Database\Seeders;

use App\Constant\CatRoleConstant;
use App\Models\CatRole;
use Illuminate\Database\Seeder;

class CatRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = CatRole::where('code', CatRoleConstant::ADMIN)->first();
        if (is_null($admin)) {
            CatRole::create([
                'name' => 'Admin del sistema',
                'code' => 'admin',
                'description' => 'Usuario con todos los permisos del sistema'
            ]);
        }

        $user = CatRole::where('code', CatRoleConstant::USER)->first();
        if (is_null($user)) {
            CatRole::create([
                'name' => 'Cuenta de usuario',
                'code' => 'user',
                'description' => 'Usuario con permisos estándar'
            ]);
        }
    }
}
