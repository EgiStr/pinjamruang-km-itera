<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rooms = array(
            0 =>
                array(
                    'id' => 1,
                    'name' => '108',
                    'notes' => 'Ruang Sekretariat KM ITERA',
                    'room_type_id' => 1,
                    'created_at' => now(),#now
                    'updated_at' => now(),
                    'deleted_at' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => '109',
                    'notes' => 'Ruang Sekretariat KM ITERA',
                    'room_type_id' => 1,
                    'created_at' => now(),#now
                    'updated_at' => now(),
                    'deleted_at' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => '111',
                    'notes' => 'Ruang Sekretariat KM ITERA',
                    'room_type_id' => 1,
                    'created_at' => now(),#now
                    'updated_at' => now(),
                    'deleted_at' => NULL,
                ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('rooms')->first()))
            \DB::table('rooms')->insert($rooms);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
