<?php

use yii\db\Migration;

/**
 * Class m200504_110823_add_pages_table
 */
class m200504_110823_add_pages_table extends Migration
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
        $this->createTable('{{%pages}}',[

            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => 'MEDIUMTEXT',
            'status' => $this->tinyInteger()->defaultValue(0),
            'meta_title' => $this->string()->notNull(),
            'meta_description' => $this->string()->notNull(),
            'meta_keywords' => $this->string()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),

        ],$tableOptions);
        $this->createIndex('{{%idx-pages-slug}}', '{{%pages}}', 'slug', true);

        $this->insert('{{%pages}}', [
            'id' => 1,
            'title' => '',
            'slug' => 'root',
            'content' => null,
            'status' => 1,
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
            'created_at'=> time(),
            'updated_at' =>time(),
            'created_by' => Yii::$app->authManager->getUserIdsByRole('admin'),
            'updated_by' => Yii::$app->authManager->getUserIdsByRole('admin')

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200504_110823_add_pages_table cannot be reverted.\n";

        return false;
    }
    */
}
