<?php

Yii::import('application.models._base.BaseNotation');

class Notation extends BaseNotation
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules()
	{
	    return array_merge(parent::rules(), array(
	       array('note', 'numerical', 'integerOnly'=>true, 'min' => 0, 'max' => 10),
	    ));
	}
}