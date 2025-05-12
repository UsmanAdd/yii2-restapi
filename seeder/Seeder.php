<?php

namespace app\seeder;

use app\seeder\tables\CourierRequestsTableSeeder;
use app\seeder\tables\CouriersTableSeeder;
use app\seeder\tables\VehiclesTableSeeder;
use diecoding\seeder\TableSeeder;

class Seeder extends TableSeeder
{
    public function run()
    {
        CouriersTableSeeder::create()->run();
        VehiclesTableSeeder::create()->run();
        CourierRequestsTableSeeder::create()->run();
    }
}