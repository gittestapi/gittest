<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TestExcution".
 *
 * @property integer $teid
 * @property string $tename
 * @property string $milestone
 * @property string $CreateDate
 */
class TestExcution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TestExcution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateDate'], 'safe'],
            [['tename', 'milestone'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teid' => 'Teid',
            'tename' => 'Tename',
            'milestone' => 'Milestone',
            'CreateDate' => 'Create Date',
        ];
    }
}
