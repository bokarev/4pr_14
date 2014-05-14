<?php

/**
 * Realize user register
 */
class RegisterController extends Controller
{

	/**
	 * @return string
	 */
	public function allowedActions()
	{
		return 'register';
	}

	/**
	 * Creates account for new users
	 */
	public function actionRegister()
	{
		if(!Yii::app()->user->isGuest)
			Yii::app()->request->redirect('/');

		$user = new User('register');
		$profile = new UserProfile;
            
                $user->role = 4;
                if(isset($_GET['tester'])) $user->role = 3;

		if(Yii::app()->request->isPostRequest && isset($_POST['User'], $_POST['UserProfile']))
		{
			$user->attributes = $_POST['User'];
			$profile->attributes = $_POST['UserProfile'];

			$valid = $user->validate();
			$valid = $profile->validate() && $valid;

			if($valid)
			{
				$user->save();
				$profile->save();
				$profile->setUser($user);

				$this->addFlashMessage(Yii::t('UsersModule.core', 'Спасибо за регистрацию на нашем сайте.'));
                                //TODO_PR : mail
                                $mailer           = Yii::app()->mail;
                                $mailer->From     = Yii::app()->params['adminEmail'];
                                $mailer->FromName = Yii::app()->settings->get('core', 'siteName');
                                $mailer->Subject  = 'Новый пользователь ' . $user->username;
                                $mailer->Body     = $user->username . ' ' . $user->login_ip . ' ' . $user->email;
                                $mailer->AddAddress('www.4pr.ru@gmail.com');
                                $mailer->AddReplyTo(Yii::app()->params['adminEmail']);
                                $mailer->isHtml(true);
                                $mailer->Send();
                                $mailer->ClearAddresses();

				// Authenticate user
				$identity = new UserIdentity($user->username, $_POST['User']['password']);
				if($identity->authenticate())
				{
					Yii::app()->user->login($identity, Yii::app()->user->rememberTime);
					Yii::app()->request->redirect($this->createUrl('/users/profile/index'));
				}
			}
		}

		$this->render('register', array(
			'user'    => $user,
			'profile' => $profile
		));
	}



	public function actionCities()
	{
        //hard code to set up country id value from Order Create (/cart) page
        if (isset($_POST['OrderCreateForm']['user_country']))
            $_POST['UserProfile']['country_id'] = $_POST['OrderCreateForm']['user_country'];

        if (isset($_POST['Order']['user_country']))
            $_POST['UserProfile']['country_id'] = $_POST['Order']['user_country'];

		if (!isset( $_POST['UserProfile']['country_id'] )) return;

	    $data=Cities::model()->findAll('country_id=:parent_id',
	                  array(':parent_id'=>(int) $_POST['UserProfile']['country_id']));

	    $data=CHtml::listData($data,'city_id','name');
	    foreach($data as $value=>$name)
	    {
	        echo CHtml::tag('option',
	                   array('value'=>$value),CHtml::encode($name),true);
	    }

	}

}
