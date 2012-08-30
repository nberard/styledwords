<?php

/**
 * This is the model base class for the table "record".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Record".
 *
 * Columns in table "record" available as properties of the model,
 * followed by relations of table "record" available as properties of the model.
 *
 * @property integer $id
 * @property string $record
 * @property integer $user_id
 *
 * @property User $user
 */
abstract class BaseRecord extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'record';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Record|Records', $n);
	}

	public static function representingColumn() {
		return 'record';
	}

	public function rules() {
		return array(
			array('record, user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('record', 'length', 'max'=>1024),
			array('id, record, user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'record' => Yii::t('app', 'Record'),
			'user_id' => null,
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('record', $this->record, true);
		$criteria->compare('user_id', $this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}