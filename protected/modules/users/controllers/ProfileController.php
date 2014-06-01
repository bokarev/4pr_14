<?php

/**
 * Profile, order and other user data.
 */
class ProfileController extends Controller
{
        private $_model;
	/**
	 * Check if user is authenticated
	 * @return bool
	 * @throws CHttpException
	 */
	public function beforeAction()
	{
		if(Yii::app()->user->isGuest)
			throw new CHttpException(404, Yii::t('UsersModule.core', 'Ошибка доступа.'));
		return true;
	}

	/**
	 * Display profile start page
	 */
	public function actionIndex()
	{
		Yii::import('application.modules.store.components.StoreUploadedImage');
		Yii::import('application.modules.users.forms.ChangePasswordForm');
		$request=Yii::app()->request;

		$user=Yii::app()->user->getModel();
		$profile=$user->profile;
		$changePasswordForm=new ChangePasswordForm();
		$changePasswordForm->user=$user;
                if($request->isPostRequest)
                {
                    if($myTest = $request->getPost('mytest'))
                    {
                        StoreProductTypeTester::model()->deleteAllByAttributes(array('user_id'=>Yii::app()->user->getId()));
               
                        foreach ($myTest as $keyId=>$mt) { 
                            $typeTester = new StoreProductTypeTester; 
                            $typeTester->user_id = Yii::app()->user->getId();
                            $typeTester->type_id = $keyId;
                            $typeTester->save();
                        }
                    }
                }

		if(Yii::app()->request->isPostRequest)
		{
                    
			if($request->getPost('UserProfile') || $request->getPost('User'))
			{
				// Handle images
				$images = CUploadedFile::getInstancesByName('UserProfile[image]');
				if($images && sizeof($images) > 0)
				{
						foreach($images as $image)
						{
							if(!StoreUploadedImage::hasErrors($image))
							{echo '111';
								$image = $profile->addImage($image); echo '444';
							}
							else
								$this->setFlashMessage(Yii::t('UsersModule.admin', 'Ошибка загрузки изображения'));
						}
				}

                // hardcode
                if (!isset($image))
                	$image = $profile->image;

				$profile->attributes=$request->getPost('UserProfile');
				$profile->image = $image;

				$user->email=isset($_POST['User']['email']) ? $_POST['User']['email'] : null;

				$valid=$profile->validate();
				$valid=$user->validate() && $valid;

				if($valid)
				{
					$user->save();
					$profile->save();

					$this->addFlashMessage(Yii::t('UsersModule.core', 'Изменения успешно сохранены.'));
					$this->refresh();
				}
			}

			if($request->getPost('ChangePasswordForm'))
			{
				$changePasswordForm->attributes=$request->getPost('ChangePasswordForm');
				if($changePasswordForm->validate())
				{
					$user->password=User::encodePassword($changePasswordForm->new_password);
					$user->save(false);
					$this->addFlashMessage(Yii::t('UsersModule.core', 'Пароль успешно изменен.'));
					$this->refresh();
				}
			}

		}
                
                $dataProvider=new CActiveDataProvider('StoreProductType',array(
                'pagination'=>array('pageSize'=>30 )) );

		$this->render('index', array(
			'user'=>$user,
                        'dataProvider'=>$dataProvider,
			'profile'=>$profile,
			'changePasswordForm'=>$changePasswordForm
		));
	}


    /**
     * Display user orders
     */
    public function actionMytests()
    {
        Yii::import('application.modules.orders.models.*');
        Yii::import('application.modules.store.models.*');

        $request=Yii::app()->request;

        if($request->isPostRequest)
        {
            if($myTest = $request->getPost('mytest'))
            {
                StoreProductTypeTester::model()->deleteAllByAttributes(array('user_id'=>Yii::app()->user->getId()));
               
                foreach ($myTest as $keyId=>$mt) { 
                    $typeTester = new StoreProductTypeTester; 
                    $typeTester->user_id = Yii::app()->user->getId();
                    $typeTester->type_id = $keyId;
                    $typeTester->save();
                }

            }
        }

        $dataProvider=new CActiveDataProvider('StoreProductType',array(
            'pagination'=>array('pageSize'=>30 )) );


        $this->render('mytests', array(
            'dataProvider'=>$dataProvider,
            'user'=>Yii::app()->user->getModel(),
        ));
    }


	/**
	 * Display user orders
	 */
	public function actionOrders()
	{


		Yii::import('application.modules.orders.models.*');
		Yii::import('application.modules.store.models.*');

		$orders=new Order('search');
		$orders->user_id=Yii::app()->user->getId();


		$this->render('orders', array(
			'orders'=>$orders,
                        'user'=>Yii::app()->user->getModel(),
		));
	}

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{       
                                //$command = Yii::app()->db->createCommand('SELECT * FROM tbl_user');
                                // следующая строка НЕ добавит WHERE к SQL
                                //$command->where('id=:id', array(':id'=>$id));

                            
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
                                
                                
                                
			}           
                        
		}
		return $this->_model;
	}

        
        public function checkPost()
	{
		$q = Yii::app()->db->createCommand()
				->select('*')
				->from('tbl_post')
				->where('id=:id', array(
					':id'=>$_GET['order'] . $_GET['id']
				))
				->queryColumn();
                return count($q);                
	}
        
        public function actionTestertests()
	{
// TODO_WUD : ! [tester]
                Yii::import('application.modules.orders.models.*');
		Yii::import('application.modules.store.models.*');

		$orders=new OrderProduct('search');
		$this->render('testertests', array(
			'orders'=>$orders,
                        'user'=>Yii::app()->user->getModel(),
                        'tests'=>$orders->getTestersTests(),
		));
        }
                                   
                     
        public function actionTests()
	{
                
		Yii::import('application.modules.orders.models.*');
		Yii::import('application.modules.store.models.*');

        $orderProduct=OrderProduct::model()->findByAttributes(array(), 'order_id='.$_GET['order'] . ' AND product_id='.$_GET['id'] );

        if(Yii::app()->request->isPostRequest)
        {
            if(Yii::app()->request->getPost('status_id'))
            {
                $orderProduct->status_id = Yii::app()->request->getPost('status_id');
                $orderProduct->save();
            }
        }

                if(isset($_GET['order']) and isset($_GET['id']))
                {
                    if(!self::checkPost()){
                        $post = new Post;
                            $post->id=$_GET['order'] . $_GET['id'];
                            $post->title='temp';
                            $post->content='temp';
                            $post->tags='temp';
                            $post->status=1;
                            $post->save();
                        
                    }

                    $test = $orderProduct->product;
                    $tester = User::model()->findByPk($orderProduct->tester_id);
                    
                    $new_post_id = $_GET['order'] . $_GET['id'];
                    $_GET['id'] = $new_post_id;
                    $post=$this->loadModel();                   
                    $post->id = $new_post_id;

                    $comment=$this->newComment($post);
                    
                }else{
                    $test = false;
                    $tester = false;
                    $post = false;
                    $comment = false;
                    $orderProduct = false;
                }
                    $orders=new Order('search');
                    $orders->user_id=Yii::app()->user->getId();

                    $this->render('tests', array(
                        'orders'=>$orders,
                        'test'=>$test,
                        'tester'=>$tester,
                        'model'=>$post,
                        'comment'=>$comment,
                        'orderProduct'=>$orderProduct,
                        'user'=>Yii::app()->user->getModel(),
                        'type'=>false,

                    ));

	}


        public function actionTestsclosed()
	{

		Yii::import('application.modules.orders.models.*');
		Yii::import('application.modules.store.models.*');

		$orders=new Order('search');
		$orders->user_id=Yii::app()->user->getId();

		$this->render('tests_closed', array(
			'orders'=>$orders,
                        'user'=>Yii::app()->user->getModel(),
		));
	}


	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{ 
		$comment=new Comment;
                if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
                if(isset($_POST['Comment']))
		{   $comment->attributes=$_POST['Comment'];
                    if($post->addComment($comment))
                    {
                        Yii::app()->user->setFlash('commentSubmitted','Спасибо  за сообщение. Сообщения заказчиков и исполнителей появляются после модерации');
                        $this->refresh();                                   
                    }                             
                }
		return $comment;
	}

}



