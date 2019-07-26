<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m190726_000006_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'rejeser_id' => $this->integer(),
            'film_id' => $this->integer(),
            'actor_id' => $this->integer(),
        ]);

        $this->createIndex(
            'comment_rejeser_rejeser_id',
            'comment',
            'rejeser_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'comment_world_rating_id',
            'comment',
            'rejeser_id',
            'rejeser',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'comment_film_id',
            'comment',
            'film_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'comment_film_id',
            'comment',
            'film_id',
            'film',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'comment_actor_id',
            'comment',
            'actor_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'comment_actor_id',
            'comment',
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
        $this->dropTable('{{%comment}}');
    }
}
