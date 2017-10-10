<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Steps".
 *
 * @property integer $sid
 * @property string $content
 * @property integer $tcid
 */
class Step extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Step';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tcid','content'], 'required'],
            [['tcid'], 'integer'],
            [['content'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sid' => 'Sid',
            'content' => 'Content',
            'tcid' => 'Tcid',
        ];
    }
}
