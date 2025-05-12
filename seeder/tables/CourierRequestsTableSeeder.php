<?php

namespace app\seeder\tables;

use diecoding\seeder\TableSeeder;
use app\models\CourierRequests;
use app\models\Couriers;
use app\models\Vehicles;

/**
 * Handles the creation of seeder `CourierRequests::tableName()`.
 */
class CourierRequestsTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    // public $locale = 'en_US';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $couriers = Couriers::find()->all();
        $vehicles = Vehicles::find()->all();

        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(CourierRequests::tableName(), [
                'courier_id' => $this->faker->randomElement($couriers)->id,
				'vehicle_id' => $this->faker->randomElement($vehicles)->id,
				'status' => $this->faker->randomElement(['started', 'holded', 'finished']),
				'deleted' => $this->faker->boolean,
				'created_at' => date('Y-m-d H:i:s', $this->faker->unixTime()),
            ]);
        }
    }
}