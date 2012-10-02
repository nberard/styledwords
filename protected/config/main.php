<?php
//update user set password=md5('Zh8PCtCchuySJJpxeclipse') where username='admin';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Styled Words',

    'sourceLanguage'=>'en',
    'language'=>'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'ext.giix.components.*', // giix components
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'eclipse',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
	        'generatorPaths' => array(
                'ext.giix.generators', // giix generators
            ),
		),
		'user'=>array(
		    'tableUsers' => 'user',
            'tableProfiles' => 'profile',
            'tableProfileFields' => 'profile_field',
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => false,
            # allow access for non-activated users
            'loginNotActiv' => true,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => true,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
            'class'=>'application.components.UrlManager',
			'urlFormat'=>'path',
		    'showScriptName'=>false,
			'rules'=>array(
                '<language:(en|fr)>'=>'/',
				'<language:(en|fr)>/<controller:\w+>'=>'<controller>/view',
				'<language:(en|fr)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<language:(en|fr)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>/id/<id>',
                '<language:(en|fr)>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>/id/<id>',
                '<language:(en|fr)>/<module:\w+>/<controller:\w+>/<action:\w+>/<idtag:\w+>/<id:\d+>'=>'<module>/<controller>/<action>/<idtag>/<id>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=styled',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'berard.nicolas@gmail.com',
        'languages' => array(
            'fr' => 'Français',
            'en' => 'English',
        ),
    ),
);