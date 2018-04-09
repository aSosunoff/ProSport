<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 */
class m180407_184419_create_contact_table extends Migration
{
    public function tinyint($length = null) {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('tinyint', $length);
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%CONTACT}}', [
            'ID' => $this->primaryKey()->unsigned(),
            'ADDRESS' => $this->string(255)->notNull(),
            'PHONE' => $this->string(255)->notNull(),
            'MAIL' => $this->string(255)->notNull(),
            'MAP' => $this->text()->notNull(),
            'ACTIVE_FLAG' => $this->tinyint(1)->unsigned()->notNull()->defaultValue(0),
            'CREATED_AT' => $this->integer()->unsigned()->notNull(),
            'UPDATED_AT' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%CONTACT}}');
    }
}
