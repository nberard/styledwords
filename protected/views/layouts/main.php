<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language; ?>" lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="<?php echo Yii::app()->language; ?>" />
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
				array('label'=>Yii::t('main', 'Home'), 'url'=>array('/'), 'active' => $this->route === 'site/index' ),
				array('label'=>Yii::t('main', 'About'), 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>Yii::t('main', 'Contact'), 'url'=>array('/site/contact')),
				array('label'=>Yii::t('main', 'Register'), 'url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest, 'active' => $this->route === 'user/registration/registration'),
				array('label'=>Yii::t('main', 'Login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest, 'active' => $this->route === 'user/login/login'),
				array('label'=>Yii::t('main', 'My Profile'), 'url'=>array('/user/profile'), 'visible'=>!Yii::app()->user->isGuest, 'active' => $this->route === 'user/profile/profile'),
				array('label'=>Yii::t('main', 'Logout ({username})', array('{username}' => !Yii::app()->user->isGuest ? Yii::app()->user->username : '')), 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
//				array('label'=>Yii::t('main', 'test ({username})', array('{username}' => Yii::app()->user->username)), 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
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
