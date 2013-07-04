<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Loogxi <ljc6qx@gmail.com>
 * Date: 2013-05-12 21:06
 * FileName: database.php
 */
return array(
	'components'=>array(
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdemo', //连接mysql数据库
			'emulatePrepare' => true,
			'username' => 'root', //MySQL数据库用户名
			'password' => '123456', //MySQL数据库用户密码
			'charset' => 'utf8', //MySQL数据库编码
			'tablePrefix' => 'tbl_', //MySQL数据库表前缀
			'enableProfiling'=>true,//同log组件的route下的CProfileLogRoute配合使用，同时在这种情况下，可以用CDbConnection::getStats() 查看执行了多少个语句，用了多少时间
		),

	),
);

