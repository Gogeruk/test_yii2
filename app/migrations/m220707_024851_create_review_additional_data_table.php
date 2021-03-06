<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review_additional_data}}`.
 */
class m220707_024851_create_review_additional_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review_additional_data}}', [
            'id' => $this->primaryKey(),
            'ip_address' => $this->string()->notNull(),
            'user_agent' => $this->string()->notNull(),
            'creation_date' => $this->timestamp()->notNull(),
            'user_review_id' => $this->integer()->null(),
        ]);

        $this->createIndex(
            'idx-review_additional_data-user_review_id',
            'review_additional_data',
            'user_review_id'
        );

        $this->addForeignKey(
            'fk-review_additional_data-user_review_id',
            'review_additional_data',
            'user_review_id',
            'user_review',
            'id',
            'SET NULL'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-review_additional_data-user_review_id',
            'review_additional_data'
        );

        $this->dropIndex(
            'idx-review_additional_data-user_review_id',
            'review_additional_data'
        );
        
        $this->dropTable('{{%review_additional_data}}');
    }
}
