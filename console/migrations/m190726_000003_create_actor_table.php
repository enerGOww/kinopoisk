<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%actor}}`.
 */
class m190726_000003_create_actor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%actor}}', [
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
        $this->dropTable('{{%actor}}');
    }
}
