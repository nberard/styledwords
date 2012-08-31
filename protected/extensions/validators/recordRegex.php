<?php
class recordRegex extends CValidator
{
    const regex = "/^([\\w']+\\s?)+$/";
    const errorMessage = "Your record should only contains words separated by space";
    
    protected function validateAttribute($object, $attribute)
    {
        if(!preg_match(self::regex, $object->$attribute))
        {
            $this->addError($object,$attribute, self::errorMessage);
        }           
    }
    
    public function clientValidateAttribute($object, $attribute)
    {
        $condition = "!value.match(".self::regex.")";
         return "if(".$condition.") {
                messages.push(".CJSON::encode(self::errorMessage).");
            }
            ";
    }
}