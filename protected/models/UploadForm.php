<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cheng
 * Date: 12-12-1
 * Time: 下午9:53
 */
class UploadForm  extends CFormModel
{
    public $image;
    //... other attributes
    public function rules()
    {
        return array(
            array('image','file','types'=>'jpg,gif,png','maxSize'=>'204800', 'allowEmpty'=>true, 'tooLarge'=>'The file was larger than 50MB. Please upload a smaller file.',),
            array('image', 'unsafe'),
        );
    }
}
