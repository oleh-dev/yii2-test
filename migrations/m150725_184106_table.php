<?php

use yii\db\Schema;
use yii\db\Migration;

class m150725_184106_table extends Migration
{
    public function up()
    {
        $this->createTable('table', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'price' => Schema::TYPE_DECIMAL . ' NOT NULL',
            'description' => Schema::TYPE_STRING . ' NOT NULL',
			'available' => Schema::TYPE_SMALLINT
        ]);
    }

    public function down()
    {
        $this->dropTable('table');
	}

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
