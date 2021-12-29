<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social}}`.
 */
class m211229_150610_create_social_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social}}', [
            'id' => $this->primaryKey(),
            'icon' => $this->string()->notNull(),
            'link' => $this->string()->notNull(),
            'admin_id' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger(2)->defaultValue(1)->comment('0 for inactive 1 for active'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social}}');
    }
}
