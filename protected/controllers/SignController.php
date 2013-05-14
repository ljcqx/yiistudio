<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: <ljc6qx@gmail.com>
 * Date: 2012.12.22
 * Time: 16:36
 * version: $Id$
 * FileName: LoginController.php
 */
class SignController extends Controller
{
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
     * Display Sign in Page
     */
    public function actionIndex(){
        if(!Yii::app()->user->isGuest){
            $this->redirect(Yii::app()->homeUrl);
        }else{
            $model=new LoginForm;

            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='sign-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
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
            $this->renderPartial('/user/sign',array('model'=>$model));
        }
    }
}
