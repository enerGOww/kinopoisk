<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%film_genre}}`.
 */
class m190726_092536_create_film_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_genre}}', [
            'id' => $this->primaryKey(),
            'film_id'=> $this->integer(),
            'genre_id'=> $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'film_genre_film_id',
            'film_genre',
            'film_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_genre_film_id',
            'film_genre',
            'film_id',
            'film',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'film_genre_genre_id',
            'film_genre',
            'genre_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'film_genre_genre_id',
            'film_genre',
            'genre_id',
            'genre',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%film_genre}}');
    }
}
