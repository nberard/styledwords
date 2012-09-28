<?php
class recordRegex extends CValidator
{
    const regex = "/^([\\w']+\\s?)+$/";
    private $errorMessage = "";
    
    public function __construct()
    {
        $this->errorMessage = Yii::t('errors', "Your record should only contains words separated by spaces");
    }
    
    protected function validateAttribute($object, $attribute)
    {
        if(!preg_match(self::regex, $object->$attribute))
        {
            $this->addError($object,$attribute, $this->errorMessage);
        }           
    }
    
    public function clientValidateAttribute($object, $attribute)
    {
        $condition = "!value.match(".self::regex.")";
         return "if(".$condition.") {
                messages.push(".CJSON::encode($this->errorMessage).");
            }
            ";
    }
}