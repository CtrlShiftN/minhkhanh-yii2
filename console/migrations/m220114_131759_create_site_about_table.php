<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%site_about}}`.
 */
class m220114_131759_create_site_about_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%site_about}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->null(),
            'image' => $this->string()->notNull(),
            'section' => $this->text()->notNull(),
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
        $this->dropTable('{{%site_about}}');
    }
}
