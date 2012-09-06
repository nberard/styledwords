<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/index.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/list.css'); 
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
        <ul class="notes-echelle">
            <?php for($i=1; $i<=$notation::maxNotation; $i++) { ?>
            <li>
                <label for="note0<?php echo $i;?>" title="Note&nbsp;: <?php echo $i;?> sur <?php echo $notation::maxNotation?>"><?php echo $i;?></label>
                <input type="radio" name="Notation[note]" id="note0<?php echo $i;?>" value="<?php echo $i;?>" />
            </li>
        <?php } ?>
        </ul>
        <div class="clear"></div>
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

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=> $record->search(),
    'columns'=>array(
        array(           
            'name'=>'record',
            'type' => 'html',
            'value'=>'CHtml::link($data->record, array("record/show/".$data->id))',
        ),         
        array(           
            'name'=>'authorName',
            'type' => 'html',
            'value'=>'CHtml::link($data->author->username, array("user/user/view/id/".$data->author->id))',
        ),
        array(           
            'name'=>'noteAvg',
            'header' => 'Notes Average',
            'value'=> array($this, 'getStartsNotation'),
        ),
        array(           
            'name'=>'noteNb',
            'header' => 'Number of notes',
            'value'=> '$data->noteNb',
        ),
    ),
)); ?>

