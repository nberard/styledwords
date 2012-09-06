<?php
class recordExists extends CValidator
{
    
    protected function validateAttribute($object, $attribute)
    {
        if($object::model()->findByAttributes(array('record' => $object->$attribute)) != null) {
            $this->addError($object,$attribute, "This record already exists");
        }
    }
}