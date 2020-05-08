<?php

use yii\db\Migration;

/**
 * Class m200504_105901_add_menus_table
 */
class m200504_105901_add_menus_table extends Migration
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
        $this->createTable('{{%menus}}',[

            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),

        ],$tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menus}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200504_105901_add_menus_table cannot be reverted.\n";

        return false;
    }
    */
}
