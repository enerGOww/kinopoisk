<?php

use yii\db\Migration;

/**
 * Handles adding name to table `{{%actor}}`.
 */
class m190729_074651_add_name_column_to_actor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%actor}}', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
