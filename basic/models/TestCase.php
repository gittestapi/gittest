<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "TestCase".
 *
 * @property integer $tcid
 * @property string $tctitle
 * @property integer $priority
 * @property integer $serverity
 * @property integer $repoid
 * @property string $area
 * @property string $category
 * @property string $tag
 * @property string $CreateDate
 */
class TestCase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TestCase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priority', 'serverity', 'repoid'], 'required'],
            [['priority', 'serverity', 'repoid'], 'integer'],
            [['CreateDate'], 'safe'],
            [['tctitle'], 'string', 'max' => 1000],
            [['area', 'category', 'tag'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tcid' => 'Tcid',
            'tctitle' => 'Tctitle',
            'priority' => 'Priority',
            'serverity' => 'Serverity',
            'repoid' => 'Repoid',
            'area' => 'Area',
            'category' => 'Category',
            'tag' => 'Tag',
            'CreateDate' => 'Create Date',
        ];
    }
	
	public function beforeSave($insert) {	
		if (parent::beforeSave($insert)) {
			// Place your custom code here
			
			$this->CreateDate = new Expression('NOW()');
			return true;
		} else {
			return false;
		}
	}
}
