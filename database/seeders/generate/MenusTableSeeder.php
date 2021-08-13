<?php

namespace Database\Seeders\generate;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
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

        \DB::table('menus')->delete();

        \DB::table('menus')->insert(array (
                0 =>
                array (
                    'id' => 1,
                    'name' => 'admin',
                    'created_at' => '2021-08-04 14:53:11',
                    'updated_at' => '2021-08-04 14:53:11',
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
