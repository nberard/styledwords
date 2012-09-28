<?php

class RecordController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		    array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('show', 'add'),
                'users'=>array('@'),
            ),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Record;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Record']))
		{
			$model->attributes=$_POST['Record'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Record']))
		{
			$model->attributes=$_POST['Record'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Record');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Record('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Record']))
			$model->attributes=$_GET['Record'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionAdd()
    {
        $recordModel = new Record;
        $notationModel = new Notation;
        $recordModel->record = $_POST['Record']['record'];
        $recordModel->language = $_POST['Record']['language'];
        $notationModel->note = isset($_POST['Notation']['note']) ? $_POST['Notation']['note'] : '';
//        Yii::trace("_POST=".var_export($_POST, true)."", "nico");
        $recordModel->author_id = Yii::app()->user->id;
        if($recordModel->save())
        {
            $notationModel->note = $_POST['Notation']['note'];
            $notationModel->user_id = Yii::app()->user->id;
            $notationModel->record_id = $recordModel->id;
            Yii::trace("recordModel id=".var_export($recordModel->id, true)."", "nico");
            if($notationModel->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', "Record successfuly added")); 
                $this->redirect(Yii::app()->baseUrl.'/'.Yii::app()->language);
            }
        }
        else 
        {
            $recordInDB = $recordModel->findByAttributes(array('record' => $_POST['Record']['record']));
            if($recordInDB != null)
            {
                $notationModel->user_id = Yii::app()->user->id;
                $notationModel->record_id = $recordInDB->id;
                Yii::trace("recordModel id=".var_export($recordInDB->id, true)."", "nico");
                if($notationModel->save())
                {
                    Yii::app()->user->setFlash('success', Yii::t('main', "This record was already existing, your note has been added")); 
                    $this->redirect(Yii::app()->baseUrl.'/'.Yii::app()->language);
                }
            }            
        }
        $errorMessage = "Error adding your record";
        if(count($errors = array_merge($recordModel->getErrors(), $notationModel->getErrors())) > 0)
        {
            $errorMessage.=": <br/>";
            foreach($errors as $model => $errorsModel)
            {
                foreach ($errorsModel as $errorModel)
                {
                    $errorMessage.=$errorModel." ; ";                
                }
            }   
            $errorMessage = substr($errorMessage, 0, -3);
        }
//        Yii::trace("res=".var_export($recordModel->getErrors(), true)."", "nico");
        Yii::app()->user->setFlash('error', $errorMessage);
        $this->render('index', array('record' => $recordModel, 'notation' => $notationModel));
    }
	
	public function actionShow($id)
	{
	    $record = Record::model()->findByPk($id);
	    if($record == null)
	    {
	        $this->redirect(Yii::app()->baseUrl.'/');
	    }
	    else 
	    {
	        $hasNotRated = true;
	        foreach($record->notations as $notation) 
	        {
	           if($notation->user->id == Yii::app()->user->id)
	           {
	               $hasNotRated = false;
	               break;
	           }
	        }
	        $this->render('show', array('model' => $record, 'hasNotRated' => $hasNotRated, 'notationModel' => Notation::model()));
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Record::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
