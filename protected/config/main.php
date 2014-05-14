<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder')
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'language'=>'ru',
	//'sourceLanguage'=>'ru',
	// pre-loading components
	'preload'=>array('log','foundation'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.payment.*',
		'application.components.validators.*',
		'application.modules.core.models.*',
		'application.modules.users.models.User',
		// Rights module
		//'application.modules.rights.*',
		//'application.modules.rights.components.*',
                'application.modules.user.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.modules.rights.*',
                'application.modules.rights.models.*',
                'application.modules.rights.components.*',
	),

	'modules'=>array(
	    'wiki' => array(
	        'userAdapter' => array(

	        ),
	    ),
		'mailbox'=>
		    array(
		    'userClass' => 'User',
		    'userIdColumn' => 'id',
		    'usernameColumn' =>  'username',
		      ),
		'action_logger',
		'admin'=>array(),
		'rights'=>array(
			'layout'=>'application.modules.admin.views.layouts.main',
			'cssFile'=>false,
			'debug'=>YII_DEBUG,
		),
		'core',
                'SensorarioComment',
                'messaging'=>array(
                    'class'=>'ext.messaging.MessagingModule',
                    'userModel'=>'User',
                ),
                'user' => array(
                // названия таблиц взяты по умолчанию, их можно изменить
                'tableUsers' => 'user',
                'tableProfiles' => 'user_profiles',
                'tableProfileFields' => 'tbl_profiles_fields',
         ),


	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'BaseUser',
			'loginUrl'=>'/users/login'
		),
                'foundation' => array("class" => "ext.foundation.components.Foundation"),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'class'=>'SUrlManager',
			'showScriptName'=>false,
			'useStrictParsing'=>true,
			'rules'=>array(
				'/'=>'store/index/index',
				'admin/auth'=>'admin/auth',
				'admin/auth/logout'=>'admin/auth/logout',
				'admin/<module:\w+>'=>'<module>/admin/default',
				'admin/<module:\w+>/<controller:\w+>'=>'<module>/admin/<controller>',
				'admin/<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/admin/<controller>/<action>',
				'admin/<module:\w+>/<controller:\w+>/<action:\w+>/*'=>'<module>/admin/<controller>/<action>',

				'filemanager/connector' => 'admin/fileManager/index',

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

				'admin'=>'admin/default/index',
				'wiki'=>'wiki/default/pageIndex',
				'wiki/default/<action:\w+>/*'=>'wiki/default/<action>',

				'mailbox/ajax/<action:\w+>/*'=>'mailbox/ajax/<action>',
				'mailbox/message/<action:\w+>/*'=>'mailbox/message/<action>',

                            	'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',

				'rights'=>'rights/assignment/view',
				'rights/<controller:\w+>/<id:\d+>'=>'rights/<controller>/view',
				'rights/<controller:\w+>/<action:\w+>/<id:\d+>'=>'rights/<controller>/<action>',
				'rights/<controller:\w+>/<action:\w+>'=>'rights/<controller>/<action>',
				'gii'=>'gii',
				'gii/<controller:\w+>'=>'gii/<controller>',
				'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
			),
		),
            //TODO_WUD : [base] config/main
		'db'=>array(
			'connectionString'=>'mysql:host=u412531.mysql.masterhost.ru;dbname=u412531',//tmn_wud
			'username'=>'u412531',
			'password'=>'ASe.tERSiD5.7e',
			'enableProfiling'       => YII_DEBUG, // Disable in production
			'enableParamLogging'    => YII_DEBUG, // Disable in production
			'emulatePrepare'        => true,
			'schemaCachingDuration' => YII_DEBUG ? 0 : 3600,
			'charset'               => 'utf8',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                                        array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace, log',
                                        'categories' => 'system.db.CDbCommand',
                                        'logFile' => 'db.log', //runtime
                                        ),				
                                ),
                       ),
                
                'request'=>array(
			'class'=>'SHttpRequest',
			'enableCsrfValidation'=>true,
			'enableCookieValidation'=>true,
			'noCsrfValidationRoutes'=>array(
				'/processPayment',
				'/accounting1c/default/',
				'/mailbox/message/'
			)
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'connectionID'=>'db',
		),
		'cache'=>array(
			'class'=>'CFileCache',
			//'class'=>'CApcCache',
		),
		'languageManager'=>array(
			'class'=>'SLanguageManager'
		),
		'fixture'=>array(
			'class'=>'system.test.CDbFixtureManager',
		),
		'cart'=>array(
			'class'=>'ext.cart.SCart',
		),
		'currency'=>array(
			'class'=>'store.components.SCurrencyManager'
		),
		'mail'=>array(
			'class'=>'ext.mailer.EMailer',
			'CharSet'=>'UTF-8',
		),
		'settings'=>array(
			'class'=>'application.components.SSystemSettings'
		),
		//'log'=>YII_DEBUG===true ? require('logging.php') : null,
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'alexeybokarev@gmail.com',
		'adminPageSize'=>30,
		'storeImages'=>array(
			'path'        => 'webroot.uploads.product',
			'userpicPath' => 'webroot.uploads.userpic',
			'thumbPath'   => 'webroot.assets.productThumbs',
			'maxFileSize' => 10*1024*1024,
			'extensions'  => array('jpg', 'jpeg','png', 'gif'),
			'types'       => array('image/gif','image/jpeg', 'image/pjpeg', 'image/png',  'image/x-png'),
			'url'         => '/uploads/product/', // With ending slash
			'userpicUrl'  => '/uploads/userpic/', // With ending slash
			'thumbUrl'    => '/assets/productThumbs/', // With ending slash
			'sizes'=>array(
				'resizeMethod'      =>'resize', // resize/adaptiveResize
				'resizeThumbMethod' =>'resize', // resize/adaptiveResize
				'maximum'           => array(800, 600), // All uploaded images
				'userpic'           => array(320, 240), // All uploaded images
			)
		)
	),
);
