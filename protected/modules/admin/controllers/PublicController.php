<?php

class PublicController extends Controller
{
	public $layout='/layouts/column2';
	public $defaultAction='index';

	/**
	 * 管理框架页
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest){
			$this->redirect(array('admin/public/login'));
		}else{
			$this->render('index');
		}
	}


	public function actionDefault(){

	}

	/**
	 * 管理框架页top
	 */
	public function actionTop(){
		if(Yii::app()->user->isGuest){
			$this->redirect(array('admin/public/login'));
		}else{
			$this->renderPartial('top');
		}
	}

	/**
	 * 管理框架页left
	 */
	public function actionLeft(){
		if(Yii::app()->user->isGuest){
			$this->redirect(array('admin/public/login'));
		}else{
			Yii::app()->getClientScript()->registerCoreScript('jquery');
			$this->layout='left';
			$this->render('left');
		}
	}

	public function actionChange(){
		$this->renderPartial('change');
	}

	public function actionMain(){
		$this->renderPartial('main');
	}

	public function actionFooter(){
		$this->renderPartial('footer');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new AdminLoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//if user already login return home
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->user->returnUrl);
		}

		// collect user input data
		if(isset($_POST['AdminLoginForm']))
		{
			$model->attributes=$_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(false);
		$this->redirect(Yii::app()->homeUrl);
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

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}