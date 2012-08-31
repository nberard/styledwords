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

<?php if(!Yii::app()->user->isGuest) { ?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form-add-record',
        'action'=>Yii::app()->baseUrl.'/site/addRecord',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div class="row">
         <?php echo $form->labelEx($record,'record'); ?>
        <?php echo $form->textField($record,'record', array('size' => 100)); ?>
        <?php echo $form->error($record,'record'); ?>        
    </div>
    <div class="row">
        <?php echo $form->labelEx($notation,'note'); ?>
        <?php echo $form->textField($notation,'note', array('size' => 1, 'maxlength' => 2,)); ?>
        <?php echo $form->error($notation,'note'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Add'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<?php } ?>

<ul class="notes-echelle">
    <li>
        <label for="note01" title="Note&nbsp;: 1 sur 3">1</label>
        <input type="radio" name="notesA" id="note01" value="1" />
    </li>
    <li>
        <label for="note02" title="Note&nbsp;: 2 sur 3">2</label>
        <input type="radio" name="notesA" id="note02" value="2" />
    </li>
    <li>
        <label for="note03" title="Note&nbsp;: 3 sur 3">3</label>
        <input type="radio" name="notesA" id="note03" value="3" />
    </li>
</ul>



