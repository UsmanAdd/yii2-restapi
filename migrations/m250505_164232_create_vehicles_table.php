<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicles}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%courier}}`
 */
class m250505_164232_create_vehicles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vehicles}}', [
            'id' => $this->primaryKey(),
            'courier_id' => $this->integer()->notNull(),
            'type' => "ENUM('car', 'scooter') NOT NULL",
            'serial_number' => $this->string()->notNull()->unique()
        ]);

        // creates index for column `courier_id`
        $this->createIndex(
            '{{%idx-vehicles-courier_id}}',
            '{{%vehicles}}',
            'courier_id'
        );

        // add foreign key for table `{{%courier}}`
        $this->addForeignKey(
            '{{%fk-vehicles-courier_id}}',
            '{{%vehicles}}',
            'courier_id',
            '{{%couriers}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%courier}}`
        $this->dropForeignKey(
            '{{%fk-vehicles-courier_id}}',
            '{{%vehicles}}'
        );

        // drops index for column `courier_id`
        $this->dropIndex(
            '{{%idx-vehicles-courier_id}}',
            '{{%vehicles}}'
        );

        $this->dropTable('{{%vehicles}}');
    }
}
