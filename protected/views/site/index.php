<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/list.css'); 
$this->pageTitle=Yii::app()->name;
?>
<h1><?php echo Yii::t('main', 'Welcome to'); ?> <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php if(!Yii::app()->user->isGuest) { ?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form-add-record',
        'action'=>Yii::app()->baseUrl.'/'.$_GET['language'].'/record/add',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'focus'=>array($record,'record'),
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
    <div class="row">
        <?php echo $form->labelEx($record,'language'); ?>
        <ul class="languages">
            <?php foreach (Yii::app()->params['languages'] as $language => $displayLanguage) {?>
            <li>
                <label for="lng-<?php echo $language;?>" id="label-lng-<?php echo $language;?>" title="<?php echo $displayLanguage ?>" <?php echo $_GET['language'] == $language ? " class='selected'" : ""?> >&nbsp;</label>
                <input type="radio" name="Record[language]" id="lng-<?php echo $language;?>" value="<?php echo $language;?>" <?php echo $_GET['language'] == $language ? " checked='checked'" : ""?> />
            </li>
        <?php } ?>
        </ul>
        <div class="clear"></div>
        <?php echo $form->error($record,'language'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('main', Yii::t('main', 'Add'))); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<?php } ?>
<hr>
<h1>TODO</h1>
<fieldset>
<div><input type="text" name="f" value="" id="thesearchbox" autocomplete="off"><ul class="autocomplete"></ul></div> 
<div><input type="submit" value="<?php echo Yii::t('main', 'Search');?>" id="thesearchbutton"></div>
</fieldset>
<hr>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'list-records', 
    'dataProvider'=> $record->search(),
    'columns'=>array(
        array(           
            'name'=>'language',
            'header' => 'Lng',
            'type' => 'html',
            'value'=> 'CHtml::tag("div", array("class" => "lng-".$data->language))',
        ),
        array(           
            'name'=>'record',
            'type' => 'html',
            'value'=>'CHtml::link($data->record, array("/record/show/id/".$data->id))',
        ),       
        array(           
            'name'=>'authorName',
            'header'=>Yii::t('main', 'Author'),
            'type' => 'html',
            'value'=>'CHtml::link($data->author->username, array("/user/user/view/id/".$data->author->id))',
        ),
        array(           
            'name'=>'noteAvg',
            'header' => Yii::t('main', 'Notes Average'),
            'value'=> array($this, 'getStartsNotation'),
        ),
        array(           
            'name'=>'noteNb',
            'header' => Yii::t('main', 'Number of notes'),
            'value'=> '$data->noteNb',
        ),
    ),
)); ?>

