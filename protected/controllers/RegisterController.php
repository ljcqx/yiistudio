<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: <ljc6qx@gmail.com>
 * Date: 2012.12.22
 * Time: 15:05
 * version: $Id$
 * FileName: registerController.php
 */
class registerController extends Controller
{
    //public $layout='//layouts/column';
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,//背景颜色
                'foreColor'=>0x009A61,   //字体颜色2040A0
                'minLength'=>5,//最短为4位
                'maxLength'=>7,//最长为4位
                'width'=>80,
                'height'=>30,
                'transparent'=>true,//显示为透明，当关闭该选项，才显示背景颜色
                //'offset'=>-2,        //设置字符偏移量
                //'controller'=>'admin',        //拥有这个动作的controller
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
            $this->renderPartial('index',array('model'=>$model));
        }
    }
}
