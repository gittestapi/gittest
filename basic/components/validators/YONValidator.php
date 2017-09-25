<?php
namespace app\components\validators;

use yii\validators\Validator;

/**
 * 验证字段只能赋予值 'y' 或 'n'，大小写不敏感
 *
 */
class YONValidator extends Validator
{
	public function init()
	{
		parent::init();
		$this->message = "%s must be either 'y' or 'n'";
	}

	public function validateAttribute($model,$attribute)
	{
		if(!in_array(strtolower($model->$attribute),['y','n'])) {
			$model->addError($attribute,sprintf($this->message,$model->getAttributeLabel($attribute)));
		}
	}

	public function clientValidateAttribute($model,$attribute,$view){
		$hideValues = json_encode(['y','n']);
		$message = json_encode(sprintf($this->message,$model->getAttributeLabel($attribute)),JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		return <<<JS
if($.inArray(value.toLowerCase(),$hideValues) === -1){
	messages.push($message);
}
JS;
	}
}