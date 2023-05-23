<?php

use yii\db\Migration;

/**
 * Class m230523_105612_alter_orders_table
 */
class m230523_105612_alter_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(){
        $this->alterColumn('orders', 'wants_id', $this->string()->notNull());
    }

    public function down() {
        $this->alterColumn('orders','wants_id', $this->decimal()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230523_105612_alter_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
