<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courses}}`.
 */
class m230511_091647_create_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->null(),
            'price' => $this->double()->null(),
            'author_id' => $this->integer()->null(),
            'status' => $this->integer()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);

        $this->createIndex(
            'idx-courses-author_id',
            'courses',
            'author_id'
        );

        $this->addForeignKey(
            'fk-courses-author_id',
            'courses',
            'author_id',
            'authors',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%courses}}');
    }
}
