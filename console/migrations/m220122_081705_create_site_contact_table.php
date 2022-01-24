<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%site_contact}}`.
 */
class m220122_081705_create_site_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%site_contact}}', [
            'id' => $this->primaryKey(),
            'gps_link' => $this->text()->notNull(),
            'logo_link' => $this->string()->notNull(),
            'company_address' => $this->string()->notNull(),
            'tel' => $this->integer()->notNull(),
            'email' => $this->string()->notNull(),
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
        $this->dropTable('{{%site_contact}}');
    }
}
