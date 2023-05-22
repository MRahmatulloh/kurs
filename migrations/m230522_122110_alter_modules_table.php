<?php

use yii\db\Migration;

/**
 * Class m230522_122110_alter_modules_table
 */
class m230522_122110_alter_modules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(){
        $this->alterColumn('modules', 'course_id', $this->integer()->null());
    }

    public function down() {
        $this->alterColumn('modules','course_id', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230522_122110_alter_modules_table cannot be reverted.\n";

        return false;
    }
    */
}
