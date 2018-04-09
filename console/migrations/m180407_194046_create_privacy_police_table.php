<?php

use yii\db\Migration;

/**
 * Handles the creation of table `privacy_police`.
 */
class m180407_194046_create_privacy_police_table extends Migration
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

        $this->createTable('{{%PRIVACY_POLICE}}', [
            'ID' => $this->primaryKey()->unsigned(),
            'NAME' => $this->string(255),
            'TEXT' => $this->text()->notNull(),
            'CHECK' => $this->tinyint(1)->unsigned()->defaultValue(0)->notNull(),
            'I_AGREE' => $this->tinyint(1)->unsigned()->notNull(),
            'CREATED_AT' => $this->integer()->unsigned()->notNull(),
            'UPDATED_AT' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%PRIVACY_POLICE}}');
    }
}
