<?php

namespace app\seeder\tables;

use diecoding\seeder\TableSeeder;
use app\models\Couriers;

/**
 * Handles the creation of seeder `Couriers::tableName()`.
 */
class CouriersTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    // public $locale = 'en_US';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        
        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(Couriers::tableName(), [
                'role' => $this->faker->randomElement(['main', 'basic']),
				'email' => $this->faker->email,
				'first_name' => $this->faker->firstName,
				'last_name' => $this->faker->lastName,
				'patronymic' => $this->faker->firstName,
            ]);
        }
    }
}