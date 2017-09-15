<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Category".
 *
 * @property integer $id
 * @property integer $repoid
 * @property string $category
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repoid'], 'required'],
            [['repoid'], 'integer'],
            [['category'], 'string', 'max' => 100],
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
            'category' => 'Category',
        ];
    }
}
