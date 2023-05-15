<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lessons}}`.
 */
class m230511_091711_create_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lessons}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(255)->null(),
            'name' => $this->string(255)->notNull(),
            'filename' => $this->string(255)->notNull(),
            'description' => $this->text()->null(),
            'module_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);

        $this->createIndex(
            'idx-lessons-module_id',
            'lessons',
            'module_id'
        );

        $this->addForeignKey(
            'fk-lessons-module_id',
            'lessons',
            'module_id',
            'modules',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lessons}}');
    }
}
