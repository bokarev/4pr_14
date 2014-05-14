<?php

/**
 * This is the model class for table "OrderTesterAgeFilter".
 *
 * The followings are the available columns in table 'OrderTesterAgeFilter':
 * @property integer $id
 * @property string $name
 * @property integer $position
 */
class OrderTesterAgeFilter extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderStatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'OrderTesterAgeFilter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, from, to', 'required'),
			array('from, to', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('title, from, to', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'       => 'ID',
			'title'    => Yii::t('OrdersModule.admin','Название'),
			'from' => Yii::t('OrdersModule.admin','Возраст С'),
			'to'   => Yii::t('OrdersModule.admin','Возраст ПО'),
		);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);

		$sort=new CSort;
		$sort->defaultOrder = $this->getTableAlias().'.position ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
}