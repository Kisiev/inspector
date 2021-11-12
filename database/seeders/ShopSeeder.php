<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    public function run()
    {
        DB::table('shop')->updateOrInsert(
            [
                'name'        => 'Лимончелло',
                'description' => 'Кафе',
                'lat'         => '34',
                'long'        => '38',
                'rate'        => '4.1',
                'city_id'     => 1,
            ]
        );
    }
}
