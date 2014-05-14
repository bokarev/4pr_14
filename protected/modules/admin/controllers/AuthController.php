<?php

class AuthController extends SAdminController
{

	public $layout = 'login';

	public function allowedActions()
	{
		return 'index, logout';
	}

	/**
	 * Display admin login page.
	 */
	public function actionIndex()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect('/admin');

		Yii::import('application.modules.admin.forms.LoginForm');
		$model = new LoginForm();
		$form =  new CForm($model->config, $model);

		if (Yii::app()->request->getIsPostRequest())
		{
			$model->attributes = $_POST['LoginForm'];

			if ($model->validate())
			{
				// Authenticate user and redirect to the dashboard
				if($model->rememberMe)
					$duration = 84600*7; // Remember for one week
				else
					$duration = 0;

				Yii::app()->user->login($model->getIdentity(), $duration);
				Yii::app()->request->redirect($this->createUrl('/admin'));
			}
		}

		$this->render('auth', array(
			'form'=>$form,
		));
	}

	/**
	 * Logout user
	 */
	public function actionLogout()
	{
		if(Yii::app()->user->isGuest)
			throw new CHttpException(405, Yii::t('AdminModule.admin', 'Ошибка. Вы еще  неавторизовались.'));

		Yii::app()->user->logout();
		Yii::app()->request->redirect($this->createUrl('/admin'));
	}

}
