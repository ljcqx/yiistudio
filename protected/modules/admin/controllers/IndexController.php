<?php
/**
 * @Filename: IndexController.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012-12-17 09:08
 */
class IndexController extends Controller
{
	public $layout = 'column1';

	public function actions()
	{
		return array(
			//captcha action renders the CAPTCHA image
			//this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'bckColor'=>0xEBF4FB,
			),
		);
	}

	public function actionIndex(){
		//注意运行yiic shell前需要改回$this->render(‘index’); 否则无法进入shell
		//$this->render('index');
		//echo $this->getId();
		//echo $this->getModule();
		//echo $this->module;
		//var_dump(Yii::app()->modules);
		//echo Yii::app()->controller->module->name;
		//echo $this->module->name;
	}

	/**
	 * 管理框架页
	 */
	public function actionDefault(){
		if(Yii::app()->user->isGuest){
			$this->redirect(array('admin/default/login'));
		}else{
			$this->renderPartial('default');
		}
	}

	/**
	 * 管理框架页top
	 */
	public function actionTop(){
		if(Yii::app()->user->isGuest){
			$this->redirect(array('admin/default/login'));
		}else{
			$this->renderPartial('top');
		}
	}

	/**
	 * 管理框架页left
	 */
	public function actionLeft(){
		if(Yii::app()->user->isGuest){
			$this->redirect(array('admin/default/login'));
		}else{
			Yii::app()->getClientScript()->registerCoreScript('jquery');
			$this->layout='left';
			$this->render('left');
		}
	}
}
