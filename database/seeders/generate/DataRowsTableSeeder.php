<?php

namespace Database\Seeders\generate;

use Illuminate\Database\Seeder;

class DataRowsTableSeeder extends Seeder
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

        \DB::table('data_rows')->delete();

        \DB::table('data_rows')->insert(array (
                0 =>
                array (
                    'id' => 1,
                    'data_type_id' => 1,
                    'field' => 'id',
                    'type' => 'number',
                    'display_name' => 'ID',
                    'required' => true,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 1,
                ),
                1 =>
                array (
                    'id' => 2,
                    'data_type_id' => 1,
                    'field' => 'name',
                    'type' => 'text',
                    'display_name' => 'Name',
                    'required' => true,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 2,
                ),
                2 =>
                array (
                    'id' => 3,
                    'data_type_id' => 1,
                    'field' => 'email',
                    'type' => 'text',
                    'display_name' => 'Email',
                    'required' => true,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 3,
                ),
                3 =>
                array (
                    'id' => 4,
                    'data_type_id' => 1,
                    'field' => 'password',
                    'type' => 'password',
                    'display_name' => 'Password',
                    'required' => true,
                    'browse' => false,
                    'read' => false,
                    'edit' => true,
                    'add' => true,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 4,
                ),
                4 =>
                array (
                    'id' => 5,
                    'data_type_id' => 1,
                    'field' => 'remember_token',
                    'type' => 'text',
                    'display_name' => 'Remember Token',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 5,
                ),
                5 =>
                array (
                    'id' => 6,
                    'data_type_id' => 1,
                    'field' => 'created_at',
                    'type' => 'timestamp',
                    'display_name' => 'Created At',
                    'required' => false,
                    'browse' => true,
                    'read' => true,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 6,
                ),
                6 =>
                array (
                    'id' => 7,
                    'data_type_id' => 1,
                    'field' => 'updated_at',
                    'type' => 'timestamp',
                    'display_name' => 'Updated At',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 7,
                ),
                7 =>
                array (
                    'id' => 8,
                    'data_type_id' => 1,
                    'field' => 'avatar',
                    'type' => 'image',
                    'display_name' => 'Avatar',
                    'required' => false,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 8,
                ),
                8 =>
                array (
                    'id' => 9,
                    'data_type_id' => 1,
                    'field' => 'user_belongsto_role_relationship',
                    'type' => 'relationship',
                    'display_name' => 'Role',
                    'required' => false,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => false,
                    'details' => '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"display_name","pivot_table":"roles","pivot":0}',
                    'order' => 10,
                ),
                9 =>
                array (
                    'id' => 10,
                    'data_type_id' => 1,
                    'field' => 'user_belongstomany_role_relationship',
                    'type' => 'relationship',
                    'display_name' => 'Roles',
                    'required' => false,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => false,
                    'details' => '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsToMany","column":"id","key":"id","label":"display_name","pivot_table":"user_roles","pivot":"1","taggable":"0"}',
                    'order' => 11,
                ),
                10 =>
                array (
                    'id' => 11,
                    'data_type_id' => 1,
                    'field' => 'settings',
                    'type' => 'hidden',
                    'display_name' => 'Settings',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 12,
                ),
                11 =>
                array (
                    'id' => 12,
                    'data_type_id' => 2,
                    'field' => 'id',
                    'type' => 'number',
                    'display_name' => 'ID',
                    'required' => true,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 1,
                ),
                12 =>
                array (
                    'id' => 13,
                    'data_type_id' => 2,
                    'field' => 'name',
                    'type' => 'text',
                    'display_name' => 'Name',
                    'required' => true,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 2,
                ),
                13 =>
                array (
                    'id' => 14,
                    'data_type_id' => 2,
                    'field' => 'created_at',
                    'type' => 'timestamp',
                    'display_name' => 'Created At',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 3,
                ),
                14 =>
                array (
                    'id' => 15,
                    'data_type_id' => 2,
                    'field' => 'updated_at',
                    'type' => 'timestamp',
                    'display_name' => 'Updated At',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 4,
                ),
                15 =>
                array (
                    'id' => 16,
                    'data_type_id' => 3,
                    'field' => 'id',
                    'type' => 'number',
                    'display_name' => 'ID',
                    'required' => true,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 1,
                ),
                16 =>
                array (
                    'id' => 17,
                    'data_type_id' => 3,
                    'field' => 'name',
                    'type' => 'text',
                    'display_name' => 'Name',
                    'required' => true,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 2,
                ),
                17 =>
                array (
                    'id' => 18,
                    'data_type_id' => 3,
                    'field' => 'created_at',
                    'type' => 'timestamp',
                    'display_name' => 'Created At',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 3,
                ),
                18 =>
                array (
                    'id' => 19,
                    'data_type_id' => 3,
                    'field' => 'updated_at',
                    'type' => 'timestamp',
                    'display_name' => 'Updated At',
                    'required' => false,
                    'browse' => false,
                    'read' => false,
                    'edit' => false,
                    'add' => false,
                    'delete' => false,
                    'details' => NULL,
                    'order' => 4,
                ),
                19 =>
                array (
                    'id' => 20,
                    'data_type_id' => 3,
                    'field' => 'display_name',
                    'type' => 'text',
                    'display_name' => 'Display Name',
                    'required' => true,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 5,
                ),
                20 =>
                array (
                    'id' => 21,
                    'data_type_id' => 1,
                    'field' => 'role_id',
                    'type' => 'text',
                    'display_name' => 'Role',
                    'required' => true,
                    'browse' => true,
                    'read' => true,
                    'edit' => true,
                    'add' => true,
                    'delete' => true,
                    'details' => NULL,
                    'order' => 9,
                ),
            ));
       } catch(Exception $e) {
         throw new Exception('Exception occur ' . $e);

         \DB::rollBack();
       }

       \DB::commit();
    }
}
