<?php

class ComponentCuController extends CrudController
{
	public $layout = '//layouts/column2';

	public function filters()
	{
		return array(
//			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index', 'view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create', 'update'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin', 'delete'),
				'users'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model = new ComponentCu;

		if (isset($_POST['ComponentCu']))
		{
			$model->attributes = $_POST['ComponentCu'];
			if ($model->save())
				$this->redirect(array('view', 'id'=>$model->id));
		}

		$this->render('create', array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if (isset($_POST['ComponentCu']))
		{
			$model->attributes = $_POST['ComponentCu'];
			if ($model->save())
				$this->redirect(array('view', 'id'=>$model->id));
		}

		$this->render('update', array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();

			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('ComponentCu');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model = new ComponentCu('search');
		$model->unsetAttributes();
		if (isset($_GET['ComponentCu']))
			$model->attributes = $_GET['ComponentCu'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model = ComponentCu::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
}
