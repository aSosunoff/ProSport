<?php

use yii\db\Migration;

class m180406_203629_create_user_table extends Migration
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

        $this->createTable('{{%USER}}', [
            'ID' => $this->primaryKey()->unsigned(),
            'USERNAME' => $this->string()->notNull()->unique(),
            'NAME' => $this->string(255),
            'SURNAME' => $this->string(255),
            'GROUP' => $this->integer()->unsigned(),
            'IMG' => $this->string(255),
            'AUTH_KEY' => $this->string(32)->notNull(),
            'PASSWORD_HASH' => $this->string()->notNull(),
            'PASSWORD_RESET_TOKEN' => $this->string()->unique(),
            'EMAIL' => $this->string()->notNull()->unique(),

            'STATUS' => $this->smallInteger()->notNull()->defaultValue(10),
            'CREATED_AT' => $this->integer()->notNull(),
            'UPDATED_AT' => $this->integer()->notNull(),
        ], $tableOptions);

//        $this->createTable('{{%BUY}}', [
//            'ID' => $this->primaryKey()->unsigned(),
//            'ID_PRODUCT' => $this->integer()->unsigned()->notNull(),
//            'NAME' => $this->string(255)->notNull(),
//            'PHONE' => $this->string(255)->notNull(),
//            'NOTE' => $this->text()->notNull(),
//            'CHECK' => $this->tinyint(1)->unsigned()->notNull()->defaultValue(0),
//            'DATE' => $this->dateTime()->notNull(),
//            'QUANTITY' => $this->integer()->unsigned()->notNull(),
//        ], $tableOptions);
//
//        $this->createIndex(
//            'INX_BUY_PRODUCT',
//            '{{%BUY}}',
//            'ID_PRODUCT'
//        );
//
//        $this->addForeignKey(
//            'FK_BUY_ID_PRODUCT',
//            '{{%BUY}}',
//            'ID_PRODUCT',
//            '{{%PRODUCT}}',
//            'ID',
//            'NO ACTION',
//            'NO ACTION'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //        $this->dropForeignKey(
//            'FK_BUY_ID_PRODUCT',
//            '{{%BUY}}'
//        );
//
//        $this->dropIndex(
//            'INX_BUY_PRODUCT',
//            '{{%BUY}}'
//        );
//
//        $this->dropTable('{{%BUY}}');
        $this->dropTable('{{%USER}}');
    }
}
