<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
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

        $user = array('email' => 'admin@admin.com', 'password' =>  Hash::make('12345678'), 'name' => 'admin', 'role' => 1);
     
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'User', 'guard_name' => 'web'],
        ];
        $permissions = [
            ['name'=>'checkout', 'guard_name'=>'web'],
            ['name'=>'add_cars', 'guard_name'=>'web'],
        ];
        $model = [
            ['role_id'=> 1, 'model_type'=>'App/User', 'model_id' => 1],
            ['role_id'=> 2, 'model_tyoe'=>'App/User', 'model_id' => 2],
        ];

        $role_permission = [
            ['permission_id'=> 2, 'role_id'=> 1],
            ['permission_id'=> 1, 'role_id'=> 2],
        ];

        $model_permissions = [
            ['permission_id'=> 1, 'model_type'=>'App/User', 'model_id' => 1],
            ['permission_id'=> 2, 'model_type'=>'App/User', 'model_id' => 1],
        ];
        DB::table('roles')->insert($roles);
        DB::table('permissions')->insert($permissions);
        DB::table('model_has_roles')->insert($model);
        DB::table('model_has_permissions')->insert($model_permissions);
        DB::table('role_has_permissions')->insert($role_permission);
        DB::table('users')->insert($user);
        }
}
