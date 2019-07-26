<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%film_actor}}`.
 */
class m190726_000044_create_film_actor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_actor}}', [
            'id' => $this->primaryKey(),
            'film_id'=> $this->integer(),
            'actor_id'=> $this->integer(),
        ]);

        $this->createIndex(
            'film_actor_film_id',
            'film_actor',
            'film_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_actor_film_id',
            'film_actor',
            'film_id',
            'film',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'film_actor_actor_id',
            'film_actor',
            'actor_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_actor_actor_id',
            'film_actor',
            'actor_id',
            'actor',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%film_actor}}');
    }
}
