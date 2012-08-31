<?php

Yii::import('application.models._base.BaseRecord');

class Record extends BaseRecord
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules()
	{
	    return array_merge(parent::rules(), array(
           array('record', 'ext.validators.recordRegex'),
           array('record', 'ext.validators.recordExists'),
        ));
	}
	
    public function beforeSave()
	{
	    $this->record = trim($this->record);
	    return true; 
	}
}