<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blogs}}`.
 */
class m230511_091729_create_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blogs}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(255)->null(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->null(),
            'photo' => $this->string(255)->null(),
            'status' => $this->integer()->defaultValue(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blogs}}');
    }
}
