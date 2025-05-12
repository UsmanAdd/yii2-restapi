<?php

namespace app\seeder\tables;

use diecoding\seeder\TableSeeder;
use app\models\Vehicles;
use app\models\Couriers;

/**
 * Handles the creation of seeder `Vehicles::tableName()`.
 */
class VehiclesTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    // public $locale = 'en_US';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $couriers = Couriers::find()->all();

        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(Vehicles::tableName(), [
                'courier_id' => $this->faker->randomElement($couriers)->id,
				'type' => $this->faker->randomElement(['car', 'scooter']),
				'serial_number' => $this->faker->regexify('[A-Z]{1}\d{3}[A-Z]{2}'),
            ]);
        }
    }
}