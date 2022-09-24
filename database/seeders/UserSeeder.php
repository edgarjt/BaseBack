<?php

namespace Database\Seeders;

use App\Constant\CatRoleConstant;
use App\Constant\UserConstant;
use App\Models\CatRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', UserConstant::EMAIL)->first();
        $systemRole = CatRole::where('code', CatRoleConstant::ADMIN)->first();

        if (is_null($user) && !is_null($systemRole)) {
            User::create([
                'name' => 'Root',
                'first_surname' => 'Root',
                'last_surname' => 'Root',
                'email' => UserConstant::EMAIL,
                'password' => Hash::make(UserConstant::PASSWORD),
                'theme' => UserConstant::THEME,
                'role_id' => $systemRole->id
            ]);
        }
    }
}
