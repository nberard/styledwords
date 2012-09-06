<?php
class UrlManager extends CUrlManager
{
    public function createUrl($route,$params=array(),$ampersand='&')
    {
        Yii::trace("UrlManager createUrl=".var_export($route, true)."", "nico");
        Yii::trace("params=".var_export($params, true)."", "nico");
        Yii::trace("GET=".var_export($_GET, true)."", "nico");
        if (!isset($params['language'])) 
        {
            if (Yii::app()->user->hasState('language'))
                Yii::app()->language = Yii::app()->user->getState('language');
            else if(isset(Yii::app()->request->cookies['language']))
                Yii::app()->language = Yii::app()->request->cookies['language']->value;
            $params['language']=Yii::app()->language;
        }
        return parent::createUrl($route, $params, $ampersand);
    }
}