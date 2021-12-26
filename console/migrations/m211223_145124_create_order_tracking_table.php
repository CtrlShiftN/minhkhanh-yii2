<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_tracking}}`.
 */
class m211223_145124_create_order_tracking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_tracking}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->bigInteger()->notNull(),
            'admin_id' => $this->bigInteger()->notNull(),
            'action' => $this->smallInteger()->notNull()->comment('0 - new,1 - processing,2 - approved,3 - shipping,4 - finished,5- cancelled,6 - expired,7 - returned,8 - postpone,9 - rejected,10 - failed,11 - fake'),
            'notes' => $this->text()->null(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->createIndex('order_tracking_order_id_index', 'order_tracking', 'order_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('order_tracking_order_id_index', 'order_tracking');
        $this->dropTable('{{%order_tracking}}');
    }
}
