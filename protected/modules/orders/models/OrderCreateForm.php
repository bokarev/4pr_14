<?php

Yii::import('store.models.StoreDeliveryMethod');

/**
 * Used in cart to create new order.
 */
class OrderCreateForm extends CFormModel
{
	public $comment;
	public $name;
	public $email;
    public $user_sex;
    public $user_country;
    public $user_city;
    public $user_age;

	public function init()
	{
		if(!Yii::app()->user->isGuest)
		{
			$profile=Yii::app()->user->getModel()->profile;
			$this->name=$profile->full_name;
			$this->email=Yii::app()->user->email;
		}
	}

	/**
	 * Validation
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('comment', 'length', 'max'=>'500'),
            array('user_sex, user_city, user_country, user_age', 'numerical', 'integerOnly'=>true),
			array('comment', 'safe', 'on'=>'search')
		);
	}

	public function attributeLabels()
	{
		return array(
			'comment'       => Yii::t('OrdersModule.core', 'Комментарий'),
            'user_age'      => Yii::t('OrdersModule.core', 'Возраст'),
            'user_city'     => Yii::t('OrdersModule.core', 'Город'),
            'user_country'  => Yii::t('OrdersModule.core', 'Страна'),
            'user_sex'      => Yii::t('OrdersModule.core', 'Пол'),
		);
	}

}
