<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tag".
 *
 * @property integer $id
 * @property integer $repoid
 * @property string $tag
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repoid'], 'required'],
            [['repoid'], 'integer'],
            [['tag'], 'string', 'max' => 100],
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
            'tag' => 'Tag',
        ];
    }
}
