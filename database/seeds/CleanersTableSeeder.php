<?php

use App\City;
use App\Cleaner;

use Illuminate\Database\Seeder;

class CleanersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = City::all()->pluck('id');
        factory(Cleaner::class, 20)->create()->each(function ($cleaner) use($cities) {
            $cleaner->cities()->sync([rand($cities->min(), $cities->max())]);
        });
    }
}
