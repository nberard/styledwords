<?php

Yii::import('application.models._base.BaseRecord');

class Record extends BaseRecord
{
    const pageSize = 10;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules()
	{
	    $parentRules = parent::rules();
	    foreach ($parentRules as &$parentRule)
	       if($parentRule[1] == 'required')
	           $parentRule[0] = str_replace('created_at', '', $parentRule[0]);
	    return array_merge($parentRules, array(
           array('record', 'ext.validators.recordRegex'),
           array('record', 'ext.validators.recordExists'),
        ));
	}
	
	public function relations()
	{
	    return array_merge(parent::relations(), array(
	       'noteNb' => array(self::STAT, 'Notation', 'record_id', 'select' => 'COUNT(id)', 'group' => 'record_id'),
	       'noteAvg' => array(self::STAT, 'Notation', 'record_id', 'select' => 'AVG(note)', 'group' => 'record_id'),
	    ));
	}
	
    public function beforeSave()
	{
	    $this->record = trim($this->record);
	    return true; 
	}
	
    public function attributeLabels() 
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['author_id'] = Yii::t('app', 'Author ID');
        return $attributeLabels;
    }
	
	public function search()
	{
	    $sort = new CSort();
        $sort->attributes = array(
            'authorName'=>array(
              'asc'=>'user.username asc',
              'desc'=>'user.username desc',
            ),
            'noteNb'=>array(
              'asc'=>'noteNb asc',
              'desc'=>'noteNb desc',
            ),
            'noteAvg'=>array(
              'asc'=>'noteAvg ASC',
              'desc'=>'noteAvg DESC',
            ),
            'record',
        );
        $sort->defaultOrder = 'noteAvg DESC';
        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->select = 'AVG(note) as noteAvg,
                             COUNT(notations.id) as noteNb,
                             record.record';
        $criteria->group = 'record_id';
        $criteria->with = array('author', 'notations');
        return new CActiveDataProvider('Record', array(
            'criteria'=>$criteria,
            'sort' => $sort,
            'pagination'=>array(
                'pageSize'=>self::pageSize,
            ),
        ));
	}
}