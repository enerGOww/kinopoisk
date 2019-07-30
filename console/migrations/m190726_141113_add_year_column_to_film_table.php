<?php

use yii\db\Migration;

/**
 * Handles adding year to table `{{%film}}`.
 */
class m190726_141113_add_year_column_to_film_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%film}}', 'year', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
