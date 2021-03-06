<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,//背景颜色
				'minLength'=>4,//最短为4位
				'maxLength'=>4,//最长为4位
				'width'=>100,
				'height'=>40,
				'transparent'=>true,//显示为透明，当关闭该选项，才显示背景颜色
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();//等价于 die,exit
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Display Sign in Page
	 */
	public function actionRegister(){
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->homeUrl);
		}else{
			$model = new RegisterForm;
			//register-form 为Form表单的id
			if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
			if(isset($_POST['RegisterForm']))
			{
				$model->attributes = $_POST['RegisterForm'];

				if($model->validate() && $model->model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
			$this->render('register',array('model'=>$model));
		}
	}

	/**
	 * @param interger $id
	 */
	public function actionForgot($id=NULL){
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer();
		$mail->IsSMTP();	//telling the class to use SMTP
		$mail->Host = 'smtp.163.com';
//		$mail->Host = 'smtp.googlemail.com';
//		$mail->Port = '465';
//		$mail->SMTPSecure = "ssl";
//		$mail->SMTPKeepAlive = true;
//		$mail->Mailer = 'smtp';
//		$mail->CharSet = 'utf-8';
//		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->Username = '13051624281@163.com';
		$mail->Password = 'feng!@#123';
		$mail->SetFrom('13051624281@163.com', 'lijicheng');
		$mail->Subject = 'PHPMailer Test Subject via smtp, basic with authentication';
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML('<h1>JUST A TEST!</h1>');
		$mail->AddAddress('499018400@qq.com','梦幻星辰');
		$mail->Send();
		Yii::app()->user->setFlash('ok','Success');
		//$this->refresh();
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(false);
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionLogging(){
		require Yii::app()->basePath.'/vendor/autoload.php';
		//use Monolog\Logger; // Trait uses are allowed in php5.4 only
		$log = new Monolog\Logger('name');
		$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
		$log->addWarning('Foo');
	}
}
























