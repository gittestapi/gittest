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
        return 'testexcution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateDate'], 'safe'],
            [['name', 'milestone'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Teid',
            'name' => 'Tename',
            'milestone' => 'Milestone',
            'CreateDate' => 'Create Date',
        ];
    }
}
