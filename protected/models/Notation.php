<?php

Yii::import('application.models._base.BaseNotation');

class Notation extends BaseNotation
{
    
    const maxNotation = 10;
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules()
	{
	    $parentRules = parent::rules();
        foreach ($parentRules as &$parentRule)
           if($parentRule[1] == 'required') 
               $parentRule[0] = str_replace(array('attributed_at, ', 'attributed_at'), '', $parentRule[0]);
	    return array_merge($parentRules, array(
	       array('note', 'numerical', 'integerOnly'=>true, 'min' => 0, 'max' => self::maxNotation),
	       array('user_id', 'ext.validators.userHasAlreadyNoted'),
	    ));
	}
	
    public function attributeLabels() 
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['user_id'] = Yii::t('app', 'User ID');
        return $attributeLabels;
    }
}