<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_type}}`.
 */
class m211216_143711_create_product_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'slug' => $this->string()->unique()->null(),
            'image' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'admin_id' => $this->bigInteger(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_type}}');
    }
}
