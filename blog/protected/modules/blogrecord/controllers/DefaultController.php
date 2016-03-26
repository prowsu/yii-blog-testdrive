<?php

class DefaultController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  // Разрешить пользователям смотреть блог
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // Разрешить администратору редактировать блогозаписи
				'actions'=>array('create','edit','delete'),
				'expression'=>'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	public function actionIndex()
	{
		$this->render('index',array('hidden'=>(isset($_GET['hidden']) && $_GET['hidden'] == 1)));
	}
	
	public function actionCreate()
	{
		$model=new BlogrecordForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='blogrecord-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['BlogrecordForm']))
		{
			$model->isNewRecord = true;
			$model->attributes=$_POST['BlogrecordForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->blogrecord())
				$this->redirect(Yii::app()->createUrl('blogrecord/default'));
		}
		// display the login form
		$this->render('create',array('model'=>$model));
	}
	
	public function actionEdit() // Ну это уже полный ****** :)
	{
		$model=new BlogrecordForm;
		$model->id=@intval($_GET['id']);
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='blogrecord-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['BlogrecordForm']) && $model->id > 0)
		{
			$model->attributes=$_POST['BlogrecordForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->blogrecord())
				$this->redirect(Yii::app()->createUrl('blogrecord/default'));
		}
		$row = Yii::app()->db->createCommand(array(
			'select' => array('*'),
			'from' => 'tbl_blogrecord',
			'where' => 'id=:id',
			'limit' => 1,
			'params' => array(':id'=>$model->id),
		))->queryRow();
		// display the login form
		$this->render('edit',array('model'=>$model,'data'=>$row));
	}
}