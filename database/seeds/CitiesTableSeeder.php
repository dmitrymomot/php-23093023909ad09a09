<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert(['city' => 'New York City', 'state' => 'NY']);
        DB::table('cities')->insert(['city' => 'Albany', 'state' => 'NY']);
        DB::table('cities')->insert(['city' => 'Buffalo', 'state' => 'NY']);
        DB::table('cities')->insert(['city' => 'Hudson', 'state' => 'NY']);
        DB::table('cities')->insert(['city' => 'New Rochelle', 'state' => 'NY']);
        DB::table('cities')->insert(['city' => 'Los Angeles', 'state' => 'CA']);
        DB::table('cities')->insert(['city' => 'San Diego', 'state' => 'CA']);
        DB::table('cities')->insert(['city' => 'San Jose', 'state' => 'CA']);
        DB::table('cities')->insert(['city' => 'San Francisco', 'state' => 'CA']);
        DB::table('cities')->insert(['city' => 'Sacramento', 'state' => 'CA']);
    }
}
