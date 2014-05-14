<?php

class MessageController extends Controller
{

	public $defaultAction = 'view';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id=null)
	{
		if (Yii::app()->user->isGuest) {
			$this->redirect('/users/login');
		}

		$model = new MessageForm;

		$is_valid_form = true;
		if(isset($_POST['MessageForm']))
		{
			$model->attributes=$_POST['MessageForm'];
			if($is_valid_form = $model->validate()){
				$gr = Yii::app()->getModule('messaging')->openGroup($model->receiver);
				Yii::app()->getModule('messaging')->sendMessage($gr, $model->msg);
				$this->redirect(array('/message/view'));
			}
		}

		//---------- request new messages ------------------
		$unread_gr = Yii::app()->getModule('messaging')->getUnreadGroups();
		if(empty($unread_gr)){$unread_gr = array(0);}
		$messageDataProvider = Yii::app()->getModule('messaging')->getMessagesDp($unread_gr);
		//--------- END: request new messages ------------

		//--------- request sent messages-----------------
		$sentMsgDataProvider = Yii::app()->getModule('messaging')->getSentMessagesDp();
		//--------- END: request sent messages

		$this->render('message',array(
			'model'=>$model,
			'messageDataProvider'=>$messageDataProvider,
			'is_valid_form'=>$is_valid_form,
			'sentMsgDataProvider'=>$sentMsgDataProvider
		));


	}

//	public function actionDelete($id)
//	{
//		$this->loadModel($id)->delete();
//
//		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//	}

}
