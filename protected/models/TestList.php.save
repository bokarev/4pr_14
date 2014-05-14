<?php

/**
 * This is the model class for table "sb_tests".
 *
 * The followings are the available columns in table 'sb_tests':
 * @property string $code
 * @property string $title
 * @property string $parent_id
 * @property string $order_no
 * @property string $id
 * @property string $description
 */
class TestList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TestList the static model class
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
		return 'sb_tests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required'),
			array('code', 'length', 'max'=>100),
			array('title', 'length', 'max'=>255),
			array('parent_id', 'length', 'max'=>20),
			array('order_no', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, title, parent_id, order_no, id, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => 'Code',
			'title' => 'Title',
			'parent_id' => 'Parent',
			'order_no' => 'Order No',
			'id' => 'ID',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('code',$this->code,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('order_no',$this->order_no,true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getTestsList()
	{
		$tests = Yii::app()->db->createCommand()
				->select('id, title')
				->from(self::model()->tableName())
				->queryAll();
		
		return CHtml::listData($tests, 'id', 'title');
	}
}