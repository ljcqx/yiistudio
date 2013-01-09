<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cheng
 * Date: 12-12-1
 * Time: 下午11:00
 * To change this template use File | Settings | File Templates.
 */
class FileUpload extends CFormModel
{
    public $image;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            //note you wont need a safe rule here
            array('image', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, gif, png'),
        );
    }
}
