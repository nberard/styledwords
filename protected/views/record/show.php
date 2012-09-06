<?php
/* @var $this RecordController */
/* @var $model Record */

$this->breadcrumbs=array(
	'Show record "'.$model->record.'"',
);
?>

<p>The record <span class="record-name"><?php echo $model->record; ?></span> was created by <?php echo CHtml::link($model->author->username, array('user/user/view/id/'.$model->author_id)); ?></p>
