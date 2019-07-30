<?php

use yii\db\Migration;

/**
 * Handles adding created_by to table `{{%comment}}`.
 */
class m190726_145951_add_created_by_column_to_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%comment}}', 'parent_id', $this->integer()->defaultValue(0));
        $this->addColumn('{{%comment}}', 'created_by', $this->integer());
        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-comment-parent_id}}',
            '{{%comment}}',
            'parent_id'
        );
        // add foreign key for table `{{%comment}}`
        $this->addForeignKey(
            '{{%fk-comment-parent_id}}',
            '{{%comment}}',
            'parent_id',
            '{{%comment}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-comment-created_by}}',
            '{{%comment}}',
            'created_by'
        );
        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-comment-created_by}}',
            '{{%comment}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
