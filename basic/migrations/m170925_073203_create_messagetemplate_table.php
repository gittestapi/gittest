<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messagetemp`.
 */
class m170925_073203_create_messagetemplate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('messagetemplate', [
            'id' => $this->primaryKey(),
            'template'=>$this->string(),
        ],"ENGINE=InnoDB DEFAULT CHARSET=utf8");
        
        \Yii::$app->db->createCommand()->batchInsert('messagetemplate',['template'],
            [
                ["%s 申请成为项目 %s 的测试管理员"],
                ["%s 申请成为项目 %s 的测试执行员"],
                ["%s 邀请你加入项目 %s 成为其测试管理员"],
                ["%s 邀请你加入项目 %s 成为其测试执行员"],
                ["%s 邀请你加入项目 %s 成为其测试执行员"],
                ["%s 成为项目 %s 的测试管理员"],
                ["%s 成为项目 %s 的测试执行员"]
            ])->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('messagetemplate');
    }
}
