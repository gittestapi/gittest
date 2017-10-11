<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Area".
 *
 * @property integer $id
 * @property integer $repoid
 * @property string $area
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repoid'], 'required'],
            [['repoid'], 'integer'],
            [['area'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'repoid' => 'Repoid',
            'area' => 'Area',
        ];
    }
}
