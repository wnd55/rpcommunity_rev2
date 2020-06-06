<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%chat}}`.
 */
class m200606_200327_add_name_column_to_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */


        public function up()
    {
        $this->addColumn('{{%chat}}', 'name', $this->string()->defaultValue(null));
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%chat}}', 'name');
    }
}
