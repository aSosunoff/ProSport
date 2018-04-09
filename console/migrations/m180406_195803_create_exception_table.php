<?php

use yii\db\Migration;

class m180406_195803_create_exception_table extends Migration
{
    public function longText() {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext');
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

        $this->createTableExceptionLogStatus($tableOptions);

        $this->createTableExceptionLog($tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-EXCEPTION_LOG-EXCEPTION_LOG_STATUS', '{{%EXCEPTION_LOG}}');
        $this->dropIndex('idx-EXCEPTION_LOG-EXCEPTION_LOG_STATUS', '{{%EXCEPTION_LOG}}');
        $this->dropTable('{{%EXCEPTION_LOG}}');

        $this->dropTable('{{%EXCEPTION_LOG_STATUS}}');
    }

    private function createTableExceptionLogStatus($tableOptions = null){
        $this->createTable('{{%EXCEPTION_LOG_STATUS}}', [
            'ID' => $this->primaryKey()->unsigned(),
            'NAME' => $this->string(255)->notNull(),
            'COLOR' => $this->string(255)->notNull(),
            'CREATED_AT' => $this->integer()->unsigned()->notNull(),
            'UPDATED_AT' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->insert('{{%EXCEPTION_LOG_STATUS}}', [
            'ID' => 1,
            'NAME' => 'Новая',
            'COLOR' => '#ff6e6e',
            'CREATED_AT' => time(),
            'UPDATED_AT' => time()
        ], $tableOptions);

        $this->insert('{{%EXCEPTION_LOG_STATUS}}', [
            'ID' => 2,
            'NAME' => 'Исправлена',
            'COLOR' => '#8ee28e',
            'CREATED_AT' => time(),
            'UPDATED_AT' => time()
        ], $tableOptions);
    }

    private function createTableExceptionLog($tableOptions = null){
        $this->createTable('{{%EXCEPTION_LOG}}', [
            'ID' => $this->primaryKey()->unsigned(),
            'ID_EXCEPTION_LOG_STATUS' => $this->integer()->unsigned()->notNull(),
            'MESSAGE' => $this->text()->null(),
            'CODE' => $this->integer()->unsigned()->null(),
            'FINE' => $this->string(500)->null(),
            'LINE' => $this->integer()->unsigned()->null(),
            'TRACE' => $this->longText()->null(),
            'CREATED_AT' => $this->integer()->unsigned()->notNull(),
            'UPDATED_AT' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-EXCEPTION_LOG-EXCEPTION_LOG_STATUS',
            '{{%EXCEPTION_LOG}}',
            'ID_EXCEPTION_LOG_STATUS'
        );

        $this->addForeignKey(
            'fk-EXCEPTION_LOG-EXCEPTION_LOG_STATUS',
            '{{%EXCEPTION_LOG}}',
            'ID_EXCEPTION_LOG_STATUS',
            '{{%EXCEPTION_LOG_STATUS}}',
            'ID',
            'NO ACTION',
            'NO ACTION'
        );
    }

}
