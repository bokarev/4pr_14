<?php

/**
 * Public profile data.
 */
class PublicController extends Controller
{

	/**
	 * Display profile start page
	 */
	public function actionIndex($id)
	{
		$user=User::model()->findByPk($id);

		if (!$user)
			$this->redirect('/');

		$profile=$user->profile;

		$this->render('index', array(
			'user'=>$user,
			'profile'=>$profile,
		));
	}


}
