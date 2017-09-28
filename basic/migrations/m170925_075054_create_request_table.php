<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request`.
 */
class m170925_075054_create_request_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('request', [
            'id' => $this->primaryKey(),
            'applicantID' => $this->integer(),
            'approverID' => $this->integer(),
            'repoID' => $this->integer(),
            'mtID' => $this->integer(),
            'role' => $this->char(1),
            'isApproved' => $this->char(1),
            'created_at' => $this->datetime()
        ],"ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->addForeignKey("ref_user1",'request','applicantID','user','uid',"SET NULL");
        $this->addForeignKey("ref_user2",'request','approverID','user','uid',"SET NULL");
        $this->addForeignKey("f_repo","request","repoID","repo","repoid","SET NULL");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('request');
    }
}
