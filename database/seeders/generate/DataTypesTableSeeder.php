<?php

namespace Database\Seeders\generate;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
     try {
        \DB::beginTransaction();

        \DB::table('data_types')->delete();

        \DB::table('data_types')->insert(array (
                0 =>
                array (
                    'id' => 1,
                    'name' => 'users',
                    'slug' => 'users',
                    'display_name_singular' => 'User',
                    'display_name_plural' => 'Users',
                    'icon' => 'voyager-person',
                    'model_name' => 'TCG\\Voyager\\Models\\User',
                    'description' => '',
                    'generate_permissions' => true,
                    'created_at' => '2021-08-04 14:53:11',
                    'updated_at' => '2021-08-04 14:53:11',
                    'server_side' => 0,
                    'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                    'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                    'details' => NULL,
                ),
                1 =>
                array (
                    'id' => 2,
                    'name' => 'menus',
                    'slug' => 'menus',
                    'display_name_singular' => 'Menu',
                    'display_name_plural' => 'Menus',
                    'icon' => 'voyager-list',
                    'model_name' => 'TCG\\Voyager\\Models\\Menu',
                    'description' => '',
                    'generate_permissions' => true,
                    'created_at' => '2021-08-04 14:53:11',
                    'updated_at' => '2021-08-04 14:53:11',
                    'server_side' => 0,
                    'controller' => '',
                    'policy_name' => NULL,
                    'details' => NULL,
                ),
                2 =>
                array (
                    'id' => 3,
                    'name' => 'roles',
                    'slug' => 'roles',
                    'display_name_singular' => 'Role',
                    'display_name_plural' => 'Roles',
                    'icon' => 'voyager-lock',
                    'model_name' => 'TCG\\Voyager\\Models\\Role',
                    'description' => '',
                    'generate_permissions' => true,
                    'created_at' => '2021-08-04 14:53:11',
                    'updated_at' => '2021-08-04 14:53:11',
                    'server_side' => 0,
                    'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                    'policy_name' => NULL,
                    'details' => NULL,
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
