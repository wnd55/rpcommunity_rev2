<?php

use yii\db\Migration;

/**
 * Class m200504_201158_add_categories_pages_id_to_pages_table
 */
class m200504_201158_add_categories_pages_id_to_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pages}}', 'categories_pages_id', $this->integer());
        $this->createIndex('{{%idx-pages-categories_pages_id}}', '{{%pages}}','categories_pages_id');
        $this->addForeignKey('{{%fk-pages-categories_pages_id}}', '{{%pages}}','categories_pages_id', '{{%categories_pages}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200504_201158_add_categories_pages_id_to_pages_table cannot be reverted.\n";

        return false;
    }
    */
}
