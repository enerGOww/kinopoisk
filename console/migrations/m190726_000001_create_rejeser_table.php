<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rejeser}}`.
 */
class m190726_000001_create_rejeser_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rejeser}}', [
            'id' => $this->primaryKey(),
            'year' => $this->date(),
            'place' => $this->string(),
            'height' => $this->integer(),
            'reward' => $this->string(),
            'image' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rejeser}}');
    }
}
