<?php

class UploadController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    public function actionCreate()
	{
        $model = new UploadForm();
        if(isset($_POST['UploadForm']))
        {
            $model->attributes = $_POST['UploadForm'];
            $model->image=CUploadedFile::getInstance($model,'image');

            if($model->save())
            {
                $model->image->saveAs(Yii::app()->basePath . '/Uploads/data/' . date('Ym',time()) . $model->image);
                // redirect to success page
            }
        }

		$this->render('create',array('model'=>$model));
	}

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Events']))
        {
            $model->attributes=$_POST['Events'];

            $file_image = CUploadedFile::getInstance($model,'image');

            if ( (is_object($file_flyer) && get_class($file_flyer)==='CUploadedFile'))
                $model->flyer = $file_flyer;

            if($model->save())
            {
                if (is_object($file_flyer))
                    $model->flyer->saveAs(Yii::app()->basePath.'/../files/flyers/'.$model->flyer);


                //$this->redirect(array('update','id'=>$model->id));

            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function actionAjaxUpload(){
        $this->renderPartial('ajaxUpload');
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}