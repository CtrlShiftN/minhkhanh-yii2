<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_assoc}}`.
 */
class m211216_143658_create_product_assoc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_assoc}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->bigInteger()->unique()->notNull(),
            'type_id' => $this->string()->notNull()->comment('A product can have more than one type'),
            'category_id' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'admin_id' => $this->bigInteger(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
        $this->createIndex('product_assoc_product_id_index', 'product_assoc', 'product_id');
        $this->createIndex('product_assoc_type_id_index', 'product_assoc', 'type_id');
        $this->createIndex('product_assoc_category_id_index', 'product_assoc', 'category_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('product_assoc_product_id_index', 'product_assoc');
        $this->dropIndex('product_assoc_type_id_index', 'product_assoc');
        $this->dropIndex('product_assoc_category_id_index', 'product_assoc');
        $this->dropTable('{{%product_assoc}}');
    }
}
