<?php

use yii\db\Migration;

/**
 * Handles adding role to table `joinrepo`.
 */
class m170921_062604_add_role_column_to_joinrepo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('joinrepo', 'role', $this->string(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('joinrepo', 'role');
    }
}
