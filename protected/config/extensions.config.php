<?php
return array(
	'components' => array(
		'file' => array(
			'class' => 'ext.upyun.FileUpload',
			'bucketname' => '',
			'username' => '',
			'password' => '',
			//高级使用
			'opts' => array(
				'X_GMKERL_TYPE' => 'square', // 缩略图类型
				'X_GMKERL_VALUE'=> 100, // 缩略图大小
				'X_GMKERL_QUALITY' => 95, // 缩略图压缩质量
				'X_GMKERL_UNSHARP' => True // 是否进行锐化处理
			),
		),
	),
);
/**
//调用
$fileContent = file_ge_contents($file);
$pic = Yii::app()->file->uploadFileByContent($fileContent,$newFilename,$newFileExt);
if(!isset($pic['error'])){
    $path = $pic['path'];
    $url = Yii::app()->file->getFileUrl($path,'!w588');
}else{
    //TODO
}
*/
/**
//调用方法和上面一样，不过这个配置可以直接把原图生成缩略图
*/