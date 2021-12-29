<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trademark}}`.
 */
class m211216_142042_create_trademark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trademark}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string()->unique(),
            'status' => $this->smallInteger()->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'admin_id' => $this->bigInteger(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trademark}}');
    }
}
