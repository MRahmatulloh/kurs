<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m230511_091721_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(255)->null(),
            'name' => $this->string(255)->notNull(),
            'price' => $this->double()->null(),
            'filename' => $this->string(255)->notNull(),
            'photo' => $this->string(255)->null(),
            'description' => $this->text()->null(),
            'author_id' => $this->integer()->null(),
            'status' => $this->integer()->defaultValue(10),
        ]);

        $this->createIndex(
            'idx-books-author_id',
            'books',
            'author_id'
        );

        $this->addForeignKey(
            'fk-books-author_id',
            'books',
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
        $this->dropTable('{{%books}}');
    }
}
