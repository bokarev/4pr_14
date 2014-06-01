<?php

Yii::import('application.modules.pages.models.Page');
Yii::import('application.modules.users.models.UserProfile');
Yii::import('application.modules.store.models.StoreProduct');
Yii::import('application.modules.store.models.StoreProductType');

/**
 * Store start page controller
 */
class IndexController extends Controller
{

	/**
	 * Display start page
	 */
	public function actionIndex()
	{
            //TODO_PR : [dev list index page] controller  
            $devs = array(); //собираем проверочный массив с последними добавленными и апрувленными девелопперами $user->active    
            $devs_desc = array(); // массив с детализацией
            $products = array();
            foreach(StoreProductTypeTester::getDevList() as $dev){               
                foreach($dev as $k=>$v){             
                    if($k=='user_id'){                    
                        if (!in_array($v, $devs)){ //если еще нет данных по пользователю                        
                            $user = User::model()->findByAttributes(array('id'=>$v));
                            if($user->active){ // если мы его активировали
                                $user_profile = UserProfile::model()->findByAttributes(array('user_id'=>$v));                          
                                $devs_desc[$v] = array('full_name' => $user_profile->full_name, 
                                                 'username' => $user->username,
                                                 'userpic' => $user_profile->image,
                                                 'known_computer' => $user_profile->known_computer,
                                                 'products' => array());
                                $devs[] = $v;
                            }
                        }
                        $store_product_type = StoreProductType::model()->findByAttributes(array('id'=>$dev['type_id']));
                        $store_product = StoreProduct::model()->findByAttributes(array('type_id'=>$dev['type_id']));
                        $devs_desc[$v]['products'][]  = array($store_product['url'],$store_product_type['name'],$dev['type_id']); // записываем навыки  [0]=>$store_product['url'],[0]=>$store_product['type_id']             
                    }               
                }
            }
            // сделать возможность напоминания пользователям о необходимости внести эти данные
            $dataProvider=new CActiveDataProvider('StoreProductType',array(
            'pagination'=>array('pageSize'=>30 )) );
                
            $this->render('index', array(
			//'popular'=>$this->getPopular(11),
                        'dataProvider'=>$dataProvider,
                        'user'=>Yii::app()->user->getModel(),
                        'devs'=>$devs_desc,
                        'types'=>$this->getTypes(11),
			//'newest'=>$this->getNewest(4),
			'news'=>Page::model()->published()->filterByCategory(7)->findAll(array('limit'=>3))
            ));
	}

	/**
	 * Renders products list to display on the start page
	 */
	public function actionRenderProductsBlock()
	{
		$scope = Yii::app()->request->getQuery('scope');
		switch($scope)
		{
			case 'newest':
				$this->renderBlock($this->getNewest(4));
				break;

			case 'added_to_cart':
				$this->renderBlock($this->getByAddedToCart(4));
				break;
		}
	}

	/**
	 * @param $products
	 */
	protected function renderBlock($products)
	{
		foreach($products as $p)
			$this->renderPartial('_product',array('data'=>$p));
	}

	/**
	 * @param $limit
	 * @return array
	 */
	protected function getPopular($limit)
	{
		return StoreProduct::model()
			->active()
			->byViews()
			->findAll(array('limit'=>$limit));
	}
        
        
	/**
	 * @param $limit
	 * @return array
	 */
	protected function getTypes($limit)
	{
		return StoreProduct::model()
			->active()
			->byTypes()
			->findAll(array('limit'=>$limit));
	}

	/**
	 * @param $limit
	 * @return array
	 */
	protected function getByAddedToCart($limit)
	{
		return StoreProduct::model()
			->active()
			->byAddedToCart()
			->findAll(array('limit'=>$limit));
	}

	/**
	 * @param $limit
	 * @return array
	 */
	protected function getNewest($limit)
	{
		return StoreProduct::model()
			->active()
			->newest()
			->findAll(array('limit'=>$limit));
	}

}
