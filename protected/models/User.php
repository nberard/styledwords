<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
    public function beforeSave()
    {
        $this->password = md5(Yii::app()->params["salt"].$this->password);
        return true;
    }
}