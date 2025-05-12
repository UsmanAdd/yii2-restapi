<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courier_requests}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%courier}}`
 * - `{{%vehicle}}`
 */
class m250505_164645_create_courier_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courier_requests}}', [
            'id' => $this->primaryKey(),
            'courier_id' => $this->integer()->notNull(),
            'vehicle_id' => $this->integer()->notNull(),
            'status' => "ENUM('started', 'holded', 'finished') NOT NULL",
            'deleted' => $this->boolean()->notNull(),
            'created_at' => $this->timestamp()
        ]);

        // creates index for column `courier_id`
        $this->createIndex(
            '{{%idx-courier_requests-courier_id}}',
            '{{%courier_requests}}',
            'courier_id'
        );

        // add foreign key for table `{{%courier}}`
        $this->addForeignKey(
            '{{%fk-courier_requests-courier_id}}',
            '{{%courier_requests}}',
            'courier_id',
            '{{%couriers}}',
            'id',
            'CASCADE'
        );

        // creates index for column `vehicle_id`
        $this->createIndex(
            '{{%idx-courier_requests-vehicle_id}}',
            '{{%courier_requests}}',
            'vehicle_id'
        );

        // add foreign key for table `{{%vehicle}}`
        $this->addForeignKey(
            '{{%fk-courier_requests-vehicle_id}}',
            '{{%courier_requests}}',
            'vehicle_id',
            '{{%vehicles}}',
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
            '{{%fk-courier_requests-courier_id}}',
            '{{%courier_requests}}'
        );

        // drops index for column `courier_id`
        $this->dropIndex(
            '{{%idx-courier_requests-courier_id}}',
            '{{%courier_requests}}'
        );

        // drops foreign key for table `{{%vehicle}}`
        $this->dropForeignKey(
            '{{%fk-courier_requests-vehicle_id}}',
            '{{%courier_requests}}'
        );

        // drops index for column `vehicle_id`
        $this->dropIndex(
            '{{%idx-courier_requests-vehicle_id}}',
            '{{%courier_requests}}'
        );

        $this->dropTable('{{%courier_requests}}');
    }
}
