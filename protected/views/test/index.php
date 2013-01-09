<?php
/* @var $this TestController */

$this->breadcrumbs=array(
	'Test',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<?php
$this->widget('CTreeView', array(
    'persist'=>'cookie',
    'animated'=>'fast',
    'url'=>array('ajaxFillTree'),
    'htmlOptions'=>array(
        'id'=>'coverageTree',
        'class'=>'coverageTree'
    )
));
?>