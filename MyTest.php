<?php
require_once("html/quickform.php");
//建立一个表单对象
$form = new html_quickform(frmtest, post);

$form->addelement(header, header, 请登录);
$form->addelement(text, name, 用户名);
$form->addelement(password, password, 密码);
$form->addelement(submit, submit, 提交);
// 输出到浏览器
$form->display();
?>