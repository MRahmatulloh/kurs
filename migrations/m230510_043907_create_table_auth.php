<?php

use yii\db\Migration;

/**
 * Class m230512_043907_create_table_auth
 */
class m230510_043907_create_table_auth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk_auth_user_id_user_id', 'auth', 'user_id', 'user', 'id', 'restrict', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('auth');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230512_043907_create_table_auth cannot be reverted.\n";

        return false;
    }
    */
}
