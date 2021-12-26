<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m211223_145101_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'BL_code' => $this->string()->notNull(),
            'user_id' => $this->bigInteger()->notNull(),
            'product_id' => $this->bigInteger()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'province_id' => $this->bigInteger()->notNull(),
            'district_id' => $this->bigInteger()->notNull(),
            'village_id' => $this->bigInteger()->notNull(),
            'specific_address' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'notes' => $this->text()->null(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'tel' => $this->string()->notNull(),
            'admin_id' => $this->bigInteger()->notNull(),
            'logistic_method' => $this->smallInteger()->notNull()->comment('0:home delivery, 1:receive at store'),
            'status' => $this->smallInteger()->defaultValue(1)->comment('0 - new,1 - processing,2 - approved,3 - shipping,4 - finished,5- cancelled,6 - expired,7 - returned,8 - postpone,9 - rejected,10 - failed,11 - fake'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->createIndex('order_user_id_index','order','user_id');
        $this->createIndex('order_product_id_index','order','product_id');
        $this->createIndex('order_province_id_index','order','province_id');
        $this->createIndex('order_district_id_index','order','district_id');
        $this->createIndex('order_village_id_index','order','village_id');
        $this->createIndex('order_admin_id_index','order','admin_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('order_user_id_index','order');
        $this->dropIndex('order_product_id_index','order');
        $this->dropIndex('order_admin_id_index','order');
        $this->dropIndex('order_province_id_index','order');
        $this->dropIndex('order_district_id_index','order');
        $this->dropIndex('order_village_id_index','order');
        $this->dropTable('{{%order}}');
    }
}
