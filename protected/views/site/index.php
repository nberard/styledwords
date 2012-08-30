<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/index.js'); 
$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<!-- p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p-->


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'form-add-record',
    'action'=>'addRecord',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    <div class="row">
        <?php echo CHtml::label('Your record <span class="required">*</span>', 'words', array('class' => 'required')) ?>
        <?php echo Chtml::textField('words', '', array('size' => 100, 'maxlength' => 1024)) ?>
        <div class="errorMessage" id="words_em">Your record format is not valid</div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($notation,'note'); ?>
        <?php echo $form->textField($notation,'note'); ?>
        <?php echo $form->error($notation,'note'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>

<?php $this->endWidget(); ?>
</div>



