<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document}}`.
 */
class m220115_143037_create_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'link' => $this->string(),
            'product_type_id' => $this->bigInteger(),
            'admin_id' => $this->bigInteger(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%document}}');
    }
}
