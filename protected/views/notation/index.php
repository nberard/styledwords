<?php
/* @var $this NotationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notations',
);

$this->menu=array(
	array('label'=>'Create Notation', 'url'=>array('create')),
	array('label'=>'Manage Notation', 'url'=>array('admin')),
);
?>

<h1>Notations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
