<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tracking_status}}`.
 */
class m211223_145141_create_tracking_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tracking_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'slug' => $this->string()->unique(),
            'status' => $this->smallInteger(2)->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'admin_id' => $this->bigInteger(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->createIndex('tracking_status_admin_id_index', 'tracking_status', 'admin_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('tracking_status_admin_id_index', 'tracking_status');
        $this->dropTable('{{%tracking_status}}');
    }
}
