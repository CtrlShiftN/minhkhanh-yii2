<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m211215_071822_create_post_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'avatar' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'admin_id' => $this->bigInteger(),
            'viewed' => $this->integer(),
            'tag_id' => $this->string(),
            'post_category_id' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1)->comment('0 for inactive, 1 for active'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
