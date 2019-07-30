<?php

use yii\db\Migration;

/**
 * Handles adding name to table `{{%rejeser}}`.
 */
class m190729_074804_add_name_column_to_rejeser_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rejeser}}', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
