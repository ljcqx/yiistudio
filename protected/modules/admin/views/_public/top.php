<?php
/* @var $this PublicController */
$this->breadcrumbs=array(
	'Public'=>array('/admin/public'),
	'Top',
);
//echo $this->module->id . '/' . $this->id . '/' . $this->action->id;
$baseUrl = $this->module->assetsUrl;
?>
<html>
<head>
    <title>管理页面</title>
    <script language=JavaScript>
        function logout(){
            if (confirm("您确定要退出控制面板吗？")){
                alert($(this).attr('href'));
                top.location.href = $(this).attr('href');
            }else{
                return false;
            }
        }
    </script>
    <script language=JavaScript1.2>
        function showsubmenu(sid) {
            var whichEl = eval("submenu" + sid);
            var menuTitle = eval("menuTitle" + sid);
            if (whichEl.style.display == "none"){
                eval("submenu" + sid + ".style.display=\"\";");
            }else{
                eval("submenu" + sid + ".style.display=\"none\";");
            }
        }
    </script>
    <meta http-equiv=Content-Type content=text/html;charset=utf-8>
    <meta http-equiv="refresh" content="60">
    <script language=JavaScript1.2>
        function showsubmenu(sid) {
            var whichEl = eval("submenu" + sid);
            var menuTitle = eval("menuTitle" + sid);
            if (whichEl.style.display == "none"){
                eval("submenu" + sid + ".style.display=\"\";");
            }else{
                eval("submenu" + sid + ".style.display=\"none\";");
            }
        }
    </script>
    <base target="main">
    <link href="<?php echo $baseUrl;?>/images/skin.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" height="64" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
    <tr>
        <td width="61%" height="64"></td>
        <td width="39%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="74%" height="38" class="admin_txt">管理员：<b><?php echo Yii::app()->user->name;?></b> 您好,感谢登陆使用！</td>
                <td width="22%"><a href="<?php echo Yii::app()->createUrl('admin/public/logout');?>" target="_parent" ><img src="<?php echo $baseUrl;?>/images/out.gif" alt="安全退出" width="46" height="20" border="0"></a></td>
                <td width="4%">&nbsp;</td>
            </tr>
            <tr>
                <td height="19" colspan="3">&nbsp;</td>
            </tr>
        </table></td>
    </tr>
</table>
</body>
</html>
