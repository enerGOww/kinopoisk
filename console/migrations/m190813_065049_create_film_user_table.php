<?php

use yii\db\Migration;

/**
 * Class m190813_065049_film_user_table
 */
class m190813_065049_create_film_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_user}}', [
            'id' => $this->primaryKey(),
            'film_id'=> $this->integer(),
            'user_id'=> $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'film_user_film_id',
            'film_user',
            'film_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_user_film_id',
            'film_user',
            'film_id',
            'film',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'film_user_user_id',
            'film_user',
            'user_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_user_user_id',
            'film_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190813_065049_film_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190813_065049_film_user_table cannot be reverted.\n";

        return false;
    }
    */
}
