<?php
/* @var $this UploadController */

$this->breadcrumbs=array(
	'Upload'=>array('/upload'),
	'Create',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<?php
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'upload-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
// ...
echo $form->labelEx($model, 'image');
echo $form->fileField($model, 'image');
echo $form->error($model, 'image');
// ...
$this->endWidget();
?>
<!--另一个语法是使用静态调用chtml代替cactiveform。结果是同上面一样。-->
<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
...
<?php echo CHtml::activeFileField($model, 'image'); ?>
<?php echo CHtml::submitButton('Submit'); ?>
...
<?php echo CHtml::endForm(); ?>

<?php //echo CHtml::image(Yii::app()->baseUrl . '/images/' . $data->image,
    //$data->description,
    //array("class" => "clickme", "title" => $data->title, "width"=>"300", "height"=>"220")); ?>