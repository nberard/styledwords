<?php
/* @var $this RecordController */
/* @var $model Record */

$this->breadcrumbs=array(
	Yii::t('main', 'Record "{record}"', array('{record}' => $model->record)),
);
?>

<p><?php echo Yii::t('main', 'The record "{record}" was created by {username} on {date}.',
                     array(
                        '{record}' => '<em class="record-name">'.$model->record.'</em>',
                        '{username}' => CHtml::link($model->author->username, array('user/user/view/id/'.$model->author_id)),
                        '{date}' => Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($model->created_at, 'yyyy-MM-dd hh:mm:ss'),'full', 'short'),
                     ));?>
</p>
<p>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form.js');
if(!Yii::app()->user->isGuest) {
    if($hasNotRated) { 
    echo Yii::t('main', 'You want to rate this record? ');
    ?>
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'form-add-notation',
            'action'=>Yii::app()->baseUrl.'/'.$_GET['language'].'/notation/add',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); 
        echo CHtml::hiddenField('Record[record_id]', $_GET['id']);
        ?>
        <div class="row">
            <?php echo $form->labelEx($notationModel,'note'); ?>
            <ul class="notes-echelle">
                <?php for($i=1; $i<=$notationModel::maxNotation; $i++) { ?>
                <li>
                    <label for="note0<?php echo $i;?>" title="Note&nbsp;: <?php echo $i;?> sur <?php echo $notationModel::maxNotation?>"><?php echo $i;?></label>
                    <input type="radio" name="Notation[note]" id="note0<?php echo $i;?>" value="<?php echo $i;?>" />
                </li>
            <?php } ?>
            </ul>
            <div class="clear"></div>
            <?php echo $form->error($notationModel,'note'); ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('main', Yii::t('main', 'Rate'))); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <?php
    }
    foreach(Yii::app()->user->getFlashes() as $key => $message)
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
} 
?>

</p>
<?php echo Yii::t('main', 'Users who rated this record: ')?>
<ul>
<?php 
    foreach ($model->notations as $notation) {
    ?>
    <li>
    <?php echo Yii::t('main', '{username} rated a {note}/{maxNote} on {date}',
                     array(
                        '{username}' => CHtml::link($notation->user->username, array('user/user/view/id/'.$notation->user->id)),
                        '{note}' => $notation->note,
                        '{maxNote}' => $notation::maxNotation,
                        '{date}' => Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($notation->attributed_at, 'yyyy-MM-dd hh:mm:ss'),'full', 'short'),
                     ));?>
    </li>
    <?php 
    }        
?>
</ul>
