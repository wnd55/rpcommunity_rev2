<?php

use yii\db\Migration;

/**
 * Class m200504_173556_add_categories_pages__table
 */
class m200504_173556_add_categories_pages__table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {

            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%categories_pages}}', [

            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => 'MEDIUMTEXT',
            'parent'=> $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger()->defaultValue(0),
            'meta_title' => $this->string()->notNull(),
            'meta_description' => $this->string()->notNull(),
            'meta_keywords' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->createIndex('{{%idx-pages-slug}}', '{{%categories_pages}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200504_173556_add_categories_pages__table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200504_173556_add_categories_pages__table cannot be reverted.\n";

        return false;
    }
    */
}
