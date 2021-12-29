<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorite}}`.
 */
class m211223_145206_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->bigInteger()->notNull(),
            'product_id' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
        $this->createIndex('cart_product_id_index','favorite','product_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('cart_product_id_index','favorite');
        $this->dropTable('{{%favorite}}');
    }
}
