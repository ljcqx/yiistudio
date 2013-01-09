<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
<?php 
//$this->beginContent的原理：其实就是把$this->beginContent和$this->endContent里面的内容翻译成$this->beginContent('布局文件名')中的参数‘布局文件名’的文件中的$content变量
?>