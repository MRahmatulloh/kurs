<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%views}}`.
 */
class m230511_091739_create_views_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%views}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'lesson_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull(),
            'viewed_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-views-user_id',
            'views',
            'user_id'
        );

        $this->addForeignKey(
            'fk-views-user_id',
            'views',
            'user_id',
            'user',
            'id',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-views-lesson_id',
            'views',
            'lesson_id'
        );

        $this->addForeignKey(
            'fk-views-lesson_id',
            'views',
            'lesson_id',
            'lessons',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%views}}');
    }
}
