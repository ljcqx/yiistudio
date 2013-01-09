<?php
/**
 * @Filename: actionsController.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012.12.27 16:24
 *
 */
/*
 * 结构如下
protected/
    controllers/
        PostController.php
        UserController.php
        post/
            CreateAction.php
            ReadAction.php
            UpdateAction.php
        user/
            CreateAction.php
            ListAction.php
            ProfileAction.php
            UpdateAction.php
 */
class actionsController extends Controller
{
    /**
     * @return array
     * 使用动作类：为了让控制器注意到这个动作，我们要用如下方式覆盖控制器类的actions() 方法：
     */
    public function actions(){
        return array(
            'edit'=>'application.controllers.actions.UpdateAction',//使用“应用程序文件夹/controllers/post/UpdateAction.php”文件中的类来处理edit动作
        );
    }
}
