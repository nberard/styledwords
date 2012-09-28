<?php
class userHasAlreadyNoted extends CValidator
{
    
    protected function validateAttribute($object, $attribute)
    {
        if($object::model()->findByAttributes(array('user_id' => $object->$attribute, 'record_id' => $object->record_id,)) != null) {        
            $this->addError($object, 'note', Yii::t('errors', "You have already noted this record"));
       }
    }
}