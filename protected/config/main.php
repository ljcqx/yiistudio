<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$mainconfig = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'language'=>'zh_cn',
	//'source_language'=>'zh_cn',
	'timezone'=> 'PRC',// or Asia/Shanghai

	'defaultController'=>'site',//默认控制器site

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.admin.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/**/
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin'=>array('class'=>'application.modules.admin.AdminModule'),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',//这个WebUser是继承CwebUser，稍后给出它的代码
			'stateKeyPrefix'=>'member',//这个是设置前台session的前缀
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/lingyun.db',
			'emulatePrepare' => true,
			'charset' => 'utf8', //
			'tablePrefix' => 'tbl_', //
		),
		*/

		/**
		 * 必须 加载php的memecache模块
		 * CMemCache requires PHP memcache extension to be loaded.
		 */
		/*'cache'=>array( //缓存组件
			'class'=>'CMemCache',//缓存组件类
			'servers'=>array(//MemCache缓存服务器配置
				array('host'=>'server1','port'=>11211, 'weight'=>60),//缓存服务器1 weight为所占比重%
				array('host'=>'server2','port'=>11211, 'weight'=>40),//缓存服务器2
			),
		),*/

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),*/
				// uncomment the following to show log messages on web pages
				//如何在页面底部显示所有的db相关的日志 同上,配置log组件的routes中加入
				/*
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace, info, error, warning',
					'categories' => 'system.db.*',
					//'showInFireBug' => true, 将在firebug中显示日志
				),
				*/
				//把日志记录到数据库 ,运行时表applog会自动生成，如果不能生成，参照api自已建立
				/*array(
					'class'=>'CDbLogRoute',
					'logTableName'=>'applog',
					'connectionID'=>'db',
				),*/
				//如何在页面下边显示sql的查询时间,在log组件的routes中加入 ，同db组件中的enableProfiling配合使用
				/**
				 * 如何知道某一个程序段运行需要的时间
				 * 配置好CProfileLogRoute后，在需要测试的地方加上
				 * Yii::beginProfile('blockID');
				   //程序段
				 * Yii::endProfile('blockID');
				 */
				array(
					'class'=>'CProfileLogRoute',
					'levels'=>'error, warning',
					'filter'=>'CLogFilter',
				),
				//'enableParamLogging'=>true,的作用是？在日志的bind的参数后边跟数的值

				//如何记录$_GET,$_SESSION等信息，在以上的routes中各个配置中加上
				//'filter'=>'CLogFilter',
				/**
				 * log配置中的level设置不对，可能会得不到日志信息
				 * 另外level,category的值可以随便写，
				 * 只要在用yii::Log("","自定义level","自定义的category")时对应起来即可
				 */
				/**
				 * 如何记录更详细的信息，能记录stack,在入口文件中加上
				 * define('YII_TRACE_LEVEL',10);数字越大，记当的越详细
				 */
			),
		),

		//message组件类默认的是CPhpMessageSource
		'message'=>array(
			// 使用静态类方法作为事件句柄
			'onMissingTranslation' => array('MyEventHandler',
				'handleMissingTranslation'
			),
		),

		// configure gearman
		'gearman'=>array(
			'class'=>'ext.Gearman',
			'servers'=>array(
				array('host'=>'127.0.0.1', 'port'=>4730),
				//......
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>CMap::mergeArray(
		require(dirname(__FILE__).'/params.php'),
		array(
			// this is used in contact page
			'adminEmail'=>'ljc6qx@gmail.com',
			'uploadPath'=>array(
				'adv'=> dirname(__FILE__).DIRECTORY_SEPARATOR. '../../data/uploads/advimg',
			),
			'UploadDir'=>'',
			'SaveDir'=>'',
		)
	),

);

return CMap::mergeArray(
	require(dirname(__FILE__).'/database.php'),
	require(dirname(__FILE__).'/router.php'),
	require(dirname(__FILE__).'/modules.config.php'),
	require(dirname(__FILE__).'/extensions.config.php'),
	$mainconfig
);