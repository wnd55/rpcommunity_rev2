<?php

use yii\db\Migration;

/**
 * Class m200501_183037_add_host_settings_table
 */
class m200501_183037_add_host_settings_table extends Migration
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

        $this->createTable('{{%host_settings}}',[

            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->unique(),
            'value' => $this->string()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%host_settings}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200501_183037_add_host_settings_table cannot be reverted.\n";

        return false;
    }
    */
}
