<?php

use yii\db\Migration;

/**
 * Class m230525_103424_alter_lessons_table
 */
class m230525_103424_alter_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(){
        $this->alterColumn('lessons', 'status', $this->string()->notNull());
    }

    public function down() {
        $this->alterColumn('lessons','status', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230525_103424_alter_lessons_table cannot be reverted.\n";

        return false;
    }
    */
}
