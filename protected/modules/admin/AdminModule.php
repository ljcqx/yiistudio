<?php

class AdminModule extends CWebModule
{
    public $ipFilters=array('127.0.0.1','::1');

    private $_assetsUrl;

    public $defaultController='public';//默认为default
    public $defaultAction = 'login';
    //public $layout='/layouts/main';
    //public $theme = 'defatult';

	public function init()
	{
        //Yii::app()->theme = 'admin/'.$this->theme;
        //Set theme url
        //Yii::app()->themeManager->setBaseUrl(Yii::app()->theme->baseUrl);
        //Yii::app()->themeManager->setBasePath(Yii::app()->theme->basePath);
        //Set error handler
        //Yii::app()->errorHandler->errorAction = 'admin/error/error';
        /** Make sure we run the master module init function **/
        //Yii::app()->getAssetManager()->publish($baseJsPath,false,-1,YII_DEBUG);//使用前强制更新assets

        // this method is called when the module is being created
        // you may place code here to customize the module or the application
         
		 parent::init();//这步是调用main.php里的配置文件
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
        //这里重写父类里的组件
        //如有需要还可以参考API添加相应组件
           Yii::app()->setComponents(array(
               'errorHandler'=>array(
                       'class'=>'CErrorHandler',
                       'errorAction'=>$this->getId().'/public/error',
               ),
               'user'=>array(
                       'class'=>'AdminWebUser',//后台登录类实例
                       'stateKeyPrefix'=>'admin',//后台session前缀
                       'loginUrl'=>Yii::app()->createUrl($this->getId().'/public/login'),
               ),
               'assetManager'=>array(
                        'class'=>'CAssetManager',
                        'linkAssets' => false,
               ),
           ), false);
           //下面这两行我一直没搞定啥意思，貌似CWebModule里也没generatorPaths属性和findGenerators()方法
           //$this->generatorPaths[]='admin.generators';
           //$this->controllerMap=$this->findGenerators();
	}
    public function beforeControllerAction($controller, $action){
        if(parent::beforeControllerAction($controller, $action)){
            $route=$controller->id.'/'.$action->id;
            if(!$this->allowIp(Yii::app()->request->userHostAddress) && $route!=='public/error')
                    throw new CHttpException(403,"You are not allowed to access this page.");
            $publicPages=array(
                    'public/login',
                    'public/error',
            );
            if(Yii::app()->user->isGuest && !in_array($route,$publicPages))
                    Yii::app()->user->loginRequired();
            else
                    return true;
        }
        return false;
    }


	protected function allowIp($ip)
	{
        if(empty($this->ipFilters))
                return true;
        foreach($this->ipFilters as $filter)
        {
                if($filter==='*' || $filter===$ip || (($pos=strpos($filter,'*'))!==false && !strncmp($ip,$filter,$pos)))
                        return true;
        }
        return false;
	}


    /**
     * @return mixed
     * 一般来说出于安全原因不允许通过url访问protected下面的文件，assets的作用是方便模块化，插件化的
     * 将此模块下的assets发布到根目录下的assets中，进行访问
     * publish 方法不会重复发布内容。参考  publish方法的$forceCopy=false 参数
     * 然后再模块里就可以用 使用$this->module->assetsUrl就可以调用你的css等文件了
     * 注意：$this->module 是 ccontroller 的属性，代表当前控制器所属的 module
     */
    public function getAssetsUrl()
	{
        if($this->_assetsUrl===null)
                $this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias($this->getId().'.assets'));
        return $this->_assetsUrl;
	}


	public function setAssetsUrl($value)
	{
        $this->_assetsUrl=$value;
	}

    /*public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }*/
}
?>