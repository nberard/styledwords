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
	    return array_merge(parent::rules(), array(
           array('record', 'ext.validators.recordRegex'),
           array('record', 'ext.validators.recordExists'),
        ));
	}
	
	public function relations()
	{
	    return array_merge(parent::relations(), array(
	       'noteAvg' => array(self::STAT, 'Notation', 'record_id', 'select' => 'AVG(note)', 'group' => 'record_id'),
	    ));
	}
	
    public function beforeSave()
	{
	    $this->record = trim($this->record);
	    return true; 
	}
	
	public function search()
	{
	    $sort = new CSort();
        $sort->attributes = array(
            'authorName'=>array(
              'asc'=>'author.username asc',
              'desc'=>'author.username desc',
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
        $criteria->select = 'AVG(note) as noteAvg, record.record';
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