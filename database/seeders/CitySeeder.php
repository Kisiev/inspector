<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('city')->updateOrInsert(
            [
                'id' => 1,
                'name' => 'Владикавказ'
            ]
        );
    }
}
