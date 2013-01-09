<?php
/* @var $this PublicController */

$this->breadcrumbs=array(
	'Public'=>array('/admin/public'),
	'Left',
);
//echo $this->id . '/' . $this->action->id;
$baseUrl = $this->module->assetsUrl;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理页面</title>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/prototype.lite.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/moo.fx.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/moo.fx.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/left.css" />
</head>

<body>
<table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEF2FB">
    <tr>
        <td width="182" valign="top"><div id="container">
            <h1 class="type"><a href="javascript:void(0)">网站常规管理</a></h1>
            <div class="content">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?php echo Yii::app()->baseUrl;?>/images/menu_topline.gif" width="182" height="5" /></td>
                    </tr>
                </table>
                <ul class="MM">
                    <li><a href="#" target="mainFrame">基本设置</a></li>
                    <li><a href="#" target="mainFrame">邮件设置</a></li>
                    <li><a href="#" target="mainFrame">广告设置</a></li>
                    <li><a href="#" target="mainFrame">114增加</a></li>
                    <li><a href="#" target="mainFrame">114管理</a></li>
                    <li><a href="#" target="mainFrame">联系方式</a></li>
                    <li><a href="#" target="mainFrame">汇款方式</a></li>
                    <li><a href="#" target="mainFrame">增加链接</a></li>
                    <li><a href="#" target="mainFrame">管理链接</a></li>
                </ul>
            </div>
            <h1 class="type"><a href="javascript:void(0)">栏目分类管理</a></h1>
            <div class="content">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?php echo Yii::app()->baseUrl;?>/images/menu_topline.gif" width="182" height="5" /></td>
                    </tr>
                </table>
                <ul class="MM">
                    <li><a href="#" target="mainFrame">信息分类</a></li>
                    <li><a href="#" target="mainFrame">信息类型</a></li>
                    <li><a href="#" target="mainFrame">资讯分类</a></li>
                    <li><a href="#" target="mainFrame">地区设置</a></li>
                    <li><a href="#" target="mainFrame">市场联盟</a></li>
                    <li><a href="#" target="mainFrame">商家类型</a></li>
                    <li><a href="#" target="mainFrame">商家星级</a></li>
                    <li><a href="#" target="mainFrame">商品分类</a></li>
                    <li><a href="#" target="mainFrame">商品类型</a></li>
                </ul>
            </div>
            <h1 class="type"><a href="javascript:void(0)">栏目内容管理</a></h1>
            <div class="content">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?php echo Yii::app()->baseUrl;?>/images/menu_topline.gif" width="182" height="5" /></td>
                    </tr>
                </table>
                <ul class="MM">
                    <li><a href="#" target="mainFrame">信息管理</a></li>
                    <li><a href="#" target="mainFrame">张贴管理</a></li>
                    <li><a href="#" target="mainFrame">增加商家</a></li>
                    <li><a href="#" target="mainFrame">管理商家</a></li>
                    <li><a href="#" target="mainFrame">发布资讯</a></li>
                    <li><a href="#" target="mainFrame">资讯管理</a></li>
                    <li><a href="#" target="mainFrame">市场联盟</a></li>
                    <li><a href="#" target="mainFrame">名片管理</a></li>
                    <li><a href="#" target="mainFrame">商城管理</a></li>
                    <li><a href="#" target="mainFrame">商品管理</a></li>
                    <li><a href="#" target="mainFrame">商城留言</a></li>
                    <li><a href="#" target="mainFrame">商城公告</a></li>
                </ul>
            </div>
            <h1 class="type"><a href="javascript:void(0)">注册用户管理</a></h1>
            <div class="content">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?php echo Yii::app()->baseUrl;?>/images/menu_topline.gif" width="182" height="5" /></td>
                    </tr>
                </table>
                <ul class="MM">
                    <li><a href="#" target="mainFrame">会员管理</a></li>
                    <li><a href="#" target="mainFrame">留言管理</a></li>
                    <li><a href="#" target="mainFrame">回复管理</a></li>
                    <li><a href="#" target="mainFrame">订单管理</a></li>
                    <li><a href="#" target="mainFrame">举报管理</a></li>
                    <li><a href="#" target="mainFrame">评论管理</a></li>
                </ul>
            </div>
        </div>
            <h1 class="type"><a href="javascript:void(0)">其它参数管理</a></h1>
            <div class="content">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><img src="<?php echo Yii::app()->baseUrl;?>/images/menu_topline.gif" width="182" height="5" /></td>
                    </tr>
                </table>
                <ul class="MM">
                    <li><a href="#" target="mainFrame">管理设置</a></li>
                    <li><a href="#" target="mainFrame">主机状态</a></li>
                    <li><a href="#" target="mainFrame">攻击状态</a></li>
                    <li><a href="#" target="mainFrame">登陆记录</a></li>
                    <li><a href="#" target="mainFrame">运行状态</a></li>
                </ul>
            </div>
            </div>
            <script type="text/javascript">
                var contents = document.getElementsByClassName('content');
                var toggles = document.getElementsByClassName('type');

                var myAccordion = new fx.Accordion(
                        toggles, contents, {opacity: true, duration: 400}
                );
                myAccordion.showThisHideOpen(contents[0]);
            </script>
        </td>
    </tr>
</table>
</body>
</html>

