<?php

class SiteController extends Controller
{

	public function actionIndex()
	{
	}
        public function actionQuick() { 
           //TODO_PR : CJuiDialog site controller 
           $model=new QuickForm;
           $model->attributes=$_POST['QuickForm'];
           if($model->validate()) {
               $headers="From: $model->email\r\nReply-To: $model->email";
               $body = "\n\nОтправитель: ".$model->name."\t Телефон: ".$model->phone."\t Email: ".$model->email."\t Задача: ".$model->message;
               mail(Yii::app()->params['adminEmail'],'Письмо с сайта 4pr.ru от'.$model->name, $body, $headers);
           }
           Dialog::message('flash-success', 'Отправлено!', 'Спасибо, '.$model->name.'! Ваше письмо отправлено!');
           //Yii::app()->user->setFlash('messageSent', 'Спасибо, '.$model->name.'! Ваше письмо отправлено!');
           $_POST["QuickForm"]["url"] = str_replace('/index.php', '', $_POST["QuickForm"]["url"]); 
           $this->redirect(array($_POST["QuickForm"]["url"]));
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', array('error'=>$error));
		}
	}
        
        public function actionProjects()
	{       
            
                $model=new Projects;
                // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Projects']))
		{
                    
                    //TODO_WUD : после сохранения проекта подправить редирект
			$model->attributes=$_POST['Projects'];
			if($model->save())
				$this->redirect(array('viewProjects','id'=>$model->id));
		}

//                $model = Yii::app()->getModule('user')->user(); 
//		  $profile = $model->profile;
//                $this->render('projects',array(
//                    'model'=>$model,
//                    'profile'=>$profile,
//                    'err'=>false,
//                ));
                
                $dataProvider=new CActiveDataProvider('Projects');
		$this->render('projects',array(
			'dataProvider'=>$dataProvider,
                        'model'=>$model,
//                        'pagination'=>array(
//                            'pageSize'=>20,
//                        ),
//                         'pager'=>array('cssFile'=>false, 'pageSize' => 20,'class'=>'CLinkPager', 'header'=>'123'),
		));
                
                /*if (!Yii::app()->user->id) {$this->redirect(array('user/login'));}
              
                $model = Yii::app()->getModule('user')->user(); 
		$profile = $model->profile;
	    
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
				Yii::app()->user->setFlash('profileMessage',UserModule::t(""));
				$this->redirect(array('site/personal#edit'));
			} else {
                               $this->render('personal',array(
                                'model'=>$model,
                                'profile'=>$profile,
                                'err'=>true,
                                ));
                               return;
                                 
                        }                                          
                            
		}
		$this->render('projects',array(
                    'model'=>$model,
                    'profile'=>$profile,
                    'err'=>false,
                ));
                */
                 
	}
        public function actionYoutube()
	{
	    $this->render('youtube',array(
			'user'=>Yii::app()->user->getModel(),
		));

	}
}
