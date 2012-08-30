<?php
/* @var $this NotationController */
/* @var $model Notation */

$this->breadcrumbs=array(
	'Notations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Notation', 'url'=>array('index')),
	array('label'=>'Create Notation', 'url'=>array('create')),
	array('label'=>'View Notation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Notation', 'url'=>array('admin')),
);
?>

<h1>Update Notation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>