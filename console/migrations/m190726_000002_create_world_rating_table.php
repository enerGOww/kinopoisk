<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%world_rating}}`.
 */
class m190726_000002_create_world_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%world_rating}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%world_rating}}');
    }
}
