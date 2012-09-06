<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!-- blueprint CSS framework -->
	<?php
	    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/screen.css', 'screen, projection');
	    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/print.css', 'print');
	    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');
	    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form.css');
        Yii::app()->clientScript->registerCoreScript('jquery');     
        Yii::app()->clientScript->registerCoreScript('jquery.ui'); 
	?>
	<!--[if lt IE 8]>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/ie.css', 'screen, projection'); ?>
    <![endif]-->
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/'), 'active' => $this->route === 'site/index' ),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Register', 'url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest, 'active' => $this->route === 'user/registration/registration'),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest, 'active' => $this->route === 'user/login/login'),
				array('label'=>'My Profile', 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest, 'active' => $this->route === 'user/profile/profile'),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
