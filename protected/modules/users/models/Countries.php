<?php


/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $city_id
 * @property integer $country_id
 * @property string $name
 */

class Countries extends BaseModel
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'countries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('country_id, name', 'required'),			// Search
			array('country_id', 'safe', 'on'=>'search'),
		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sort'	     => Yii::t('UsersModule.core', 'Сортировка'),
			'country_id' => Yii::t('UsersModule.core', 'ID страны'),
			'name'     	 => Yii::t('UsersModule.core', 'Название'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('country_id',$this->country_id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

}
