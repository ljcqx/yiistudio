<?php
/**
 * @Filename: default.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012-12-17 11:01
 */
?>
<!DOCTYPE html>
<head>
    <meta http-equiv=”Content-Type”content=”text/html; charset=utf-8″/>
    <meta name="language" content="zh_cn" />
    <title>管理中心</title>
</head>

<frameset rows="64,*" cols="*" frameborder="0" border="0" framespacing="0">
    <frame src="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/public/top" name="topFrame" scrolling="no" noresize="noresize" id="topFrame" />
    <frameset cols="200,*" frameborder="0" border="0" framespacing="0">
        <frame src="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/public/left" scrolling="no" noresize="noresize" id="leftFrame" />
        <frame src="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/public/main" name="mainFrame" id="mainFrame"/>
    </frameset>
</frameset>
<noframes><body>
</body>
</noframes></html>
