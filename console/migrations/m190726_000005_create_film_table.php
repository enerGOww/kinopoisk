<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%film}}`.
 */
class m190726_000005_create_film_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'country' => $this->string(),
            'slogan' => $this->string(),
            'rejeser_id' => $this->integer(),
            'world_rating_id' => $this->integer(),
            'size' => $this->integer(),
            'rating' => $this->integer(),
            'image' => $this->string(),
            'trailer_link' => $this->string(),
        ]);

        $this->createIndex(
            'film_rejeser_rejeser_id',
            'film',
            'rejeser_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_rejeser_rejeser_id',
            'film',
            'rejeser_id',
            'rejeser',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'film_world_rating_id',
            'film',
            'world_rating_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_world_rating_id',
            'film',
            'world_rating_id',
            'world_rating',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%film}}');
    }
}
