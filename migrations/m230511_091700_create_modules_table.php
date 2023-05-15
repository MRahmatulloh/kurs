<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%modules}}`.
 */
class m230511_091700_create_modules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%modules}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->null(),
            'course_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);
        
        $this->createIndex(
            'idx-modules-course_id',
            'modules',
            'course_id'
        );
        
        $this->addForeignKey(
            'fk_modules-course_id',
            'modules',
            'course_id',
            'courses',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%modules}}');
    }
}
