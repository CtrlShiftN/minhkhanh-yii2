<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%geo_location}}`.
 */
class m211223_150457_create_geo_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%geo_location}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'parent' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
        $this->createIndex('geo_location_parent_id_index', 'geo_location', 'parent');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('geo_location_parent_id_index', 'geo_location');
        $this->dropTable('{{%geo_location}}');
    }
}
