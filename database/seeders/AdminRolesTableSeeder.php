<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_roles = array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Administrator',
                    'slug' => 'administrator',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Mahasiswa',
                    'slug' => 'mahasiswa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_roles')->first()))
            \DB::table('admin_roles')->insert($admin_roles);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
