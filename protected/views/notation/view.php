<?php
/* @var $this NotationController */
/* @var $model Notation */

$this->breadcrumbs=array(
	'Notations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Notation', 'url'=>array('index')),
	array('label'=>'Create Notation', 'url'=>array('create')),
	array('label'=>'Update Notation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Notation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notation', 'url'=>array('admin')),
);
?>

<h1>View Notation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'record_id',
		'user_id',
		'note',
		'attributed_at',
	),
)); ?>
