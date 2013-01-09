<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: <ljc6qx@gmail.com>
 * Date: 2012.12.01
 * Time: 23:12
 * version: $Id$
 * FileName: FileUploadController
 */
class FileUploadController extends CController
{
    public function actionUpload() {
        $model = new FileUpload();
        $form = new CForm('application.views.fileUpload.uploadForm', $model);
        if ($form->submitted('submit') && $form->validate()) {
            $form->model->image = CUploadedFile::getInstance($form->model, 'image');
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            //do something with your image here
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            Yii::app()->user->setFlash('success', 'File Uploaded');
            $this->redirect(array('upload'));
        }
        $this->render('upload', array('form' => $form));
    }
}
