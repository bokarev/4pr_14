<?php

Yii::import('application.modules.users.models.User');

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property integer $id
 * @property integer $user_id
 * @property string $full_name
 * @property string $phone
 * @property string $delivery_address
 */
class UserProfile extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
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
		return 'user_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('full_name', 'required'),
			array('full_name, foreign, known_computer, sport, food, travel, hobby, district_home, district_work, image', 'length', 'max'=>255),
			array('phone, skype, income, marital, education, profession, occupation, have_children', 'length', 'max'=>25),
			array('age', 'length', 'max'=>3),
			array('sex, have_auto, have_estate, city_id, country_id', 'numerical', 'integerOnly'=>true),
			// Search
			array('id, user_id, full_name, phone, city_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id'          => Yii::t('UsersModule.core', 'Пользователь'),
			'full_name'        => Yii::t('UsersModule.core', 'Полное Имя'),
			'phone'            => Yii::t('UsersModule.core', 'Номер телефона'),
			'skype'            => Yii::t('UsersModule.core', 'Скайп'),
  			'city_id' 		   => Yii::t('UsersModule.core', 'Город'),
  			'country_id'	   => Yii::t('UsersModule.core', 'Страна'),
  			'age' 			   => Yii::t('UsersModule.core', 'Возраст'),
			'income'           => Yii::t('UsersModule.core', 'Доход в месяц на который вы расчитываете '),
  			'marital' 		   => Yii::t('UsersModule.core', 'Семейное положение'),
  			'have_auto'		   => Yii::t('UsersModule.core', 'Наличие автомобиля'),
  			'have_estate'	   => Yii::t('UsersModule.core', 'Наличие недвижимости'),
  			'foreign' 		   => Yii::t('UsersModule.core', 'Иностранные языки'),
  			'education' 	   => Yii::t('UsersModule.core', 'Образование'),
			'profession'       => Yii::t('UsersModule.core', 'Профессия'),
  			'occupation'	   => Yii::t('UsersModule.core', 'Сайт'),
  			'have_children'	   => Yii::t('UsersModule.core', 'Наличие детей'),
  			'known_computer'   => Yii::t('UsersModule.core', 'Компьютерные технологии которыми Вы владеете'),
  			'food' 			   => Yii::t('UsersModule.core', 'Предпочтения в еде'),
			'travel'	       => Yii::t('UsersModule.core', 'Путешествия'),
  			'hobby'			   => Yii::t('UsersModule.core', 'Хобби'),
  			'sport'			   => Yii::t('UsersModule.core', 'Спорт'),
  			'sex'			   => Yii::t('UsersModule.core', 'Пол'),
  			'district_home'	   => Yii::t('UsersModule.core', 'Ближайший район и метро для Москвы (рядом с домом)'),
  			'district_work'	   => Yii::t('UsersModule.core', 'Ближайший район и метро для Москвы (рядом с работой)'),
  			'image'			   => Yii::t('UsersModule.core', 'Изображение'),
		);
	}

	/**
	 * Connect profile to user
	 * @param UserProfile $user
	 */
	public function setUser(User $user)
	{
		$this->user_id = $user->id;
		$this->save(false);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('phone',$this->phone,true);
                $criteria->compare('skype',$this->skype,true);
		$criteria->compare('city',$this->city,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	public function addImage(CUploadedFile $image)
	{
		Yii::import('application.modules.store.components.StoreUploadedImage');
		Yii::import('ext.phpthumb.PhpThumbFactory');

		$name = strtolower($this->id.'_'.crc32(microtime()).'.'.$image->getExtensionName());
		$fullPath = Yii::getPathOfAlias(Yii::app()->params['storeImages']['userpicPath']).'/'.$name;
		$image->saveAs($fullPath);
		@chmod($fullPath, 0666);

		// Resize if needed
		$thumb  = PhpThumbFactory::create($fullPath);
		$sizes  = Yii::app()->params['storeImages']['sizes'];
		$method = $sizes['resizeMethod'];
		$fullPath = Yii::getPathOfAlias(Yii::app()->params['storeImages']['userpicPath']).'/thumb_'.$name;
		$thumb->$method($sizes['userpic'][0],$sizes['userpic'][1])->save($fullPath);

		return $name;
	}


}