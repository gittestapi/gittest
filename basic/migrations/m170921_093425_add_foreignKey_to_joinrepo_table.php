<?php

use yii\db\Migration;

class m170921_093425_add_foreignKey_to_joinrepo_table extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("ref_repo","joinrepo","repoid","repo","repoid","CASCADE","CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("ref_repo","joinrepo");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170921_093425_add_foreignKey_to_joinrepo_table cannot be reverted.\n";

        return false;
    }
    */
}
