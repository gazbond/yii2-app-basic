<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Generated with: yii migrate/create create_table_example
 *
 * Class m190124_214518_create_table_example
 */
class m190124_214518_create_table_example extends Migration
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

        // create tables. note the specific order
        $this->createTable('example', [
            'id'            => Schema::TYPE_PK,
            'status'        => Schema::TYPE_SMALLINT    . ' not null',

            'title'         => Schema::TYPE_STRING      . ' null default null',
            'body'          => Schema::TYPE_TEXT        . ' not null',

            'from_user_id'  => Schema::TYPE_INTEGER     . ' not null',
            'to_user_id'    => Schema::TYPE_INTEGER     . ' not null',

            'create_time'   => Schema::TYPE_TIMESTAMP   . ' null default null',
            'update_time'   => Schema::TYPE_TIMESTAMP   . ' null default null',
        ], $tableOptions);

        // add indexes for performance optimization
        $this->createIndex('example_from_user_id', 'example', 'from_user_id');
        $this->createIndex('example_to_user_id', 'example', 'to_user_id');

        // add foreign keys for data integrity
        $this->addForeignKey('example_fk_from_user_id', 'example', 'from_user_id', 'user', 'id');
        $this->addForeignKey('example_fk_to_user_id', 'example', 'to_user_id', 'user', 'id');

        // Alternatively execute SQL multi-line string:
        /**
        $this->execute("
            CREATE TABLE example (

            )
        ");
         */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('example');

        //echo "m190124_214518_create_table_example cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190124_214518_create_table_example cannot be reverted.\n";

        return false;
    }
    */
}
