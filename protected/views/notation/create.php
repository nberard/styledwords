<?php
/* @var $this NotationController */
/* @var $model Notation */

$this->breadcrumbs=array(
	'Notations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Notation', 'url'=>array('index')),
	array('label'=>'Manage Notation', 'url'=>array('admin')),
);
?>

<h1>Create Notation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>