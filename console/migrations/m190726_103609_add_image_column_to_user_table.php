<?php

use yii\db\Migration;

/**
 * Class m190726_103609_add_image_column_to_user_table
 */
class m190726_103609_add_image_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190726_103609_add_image_coloumn_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190726_103609_add_image_coloumn_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
