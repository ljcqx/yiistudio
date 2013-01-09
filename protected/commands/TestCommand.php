<?php
/**
 * @Filename: TestCommand.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012.12.26 13:54
 */
class TestCommand extends CConsoleCommand
{
    /**
     * @var string 使用YII框架进行PHP程序的计划任务教程
     * cmd command line exec  eg. yiic Test index
     */
    public $defaultAction = 'index';//默认动作
    public function actionIndex(){
        //....
        echo Yii::app()->request->cookies;
        Yii::app()->session->sessionID;
    }
}
