<?php

use yii\db\Migration;

/**
 * Class m230512_043904_create_table_user
 */
class m230510_043904_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'role' => $this->string()->defaultValue('pupil'),
            'photo' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->null(),
            'email' => $this->string()->unique()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'last_login_at' => $this->integer()->null(),
        ]);

        $this->insert(\app\models\User::tableName(), [
            'username' => 'admin',
            'name' => 'Admin Adminbekov',
            'email' => 'admin@test.corp',
            'role' => 'admin',
            'auth_key' => 'HQCX5LwhWLXhNfpdEHOHnnXW0JW8_492',
            'password_hash' => '$2y$13$rR0huvHXZmW6U9TNjiz83eSgaiJFFPSDnJeVjq1suTam5tjc43wBu',
            'password_reset_token' => null,
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
            'last_login_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
