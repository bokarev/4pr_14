<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property integer $order_id
 * @property integer $task_id
 *
 * The followings are the available model relations:
 * @property TblPost $post
 */
class TblComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblComment the static model class
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
		return 'tbl_comment';
	}
        

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, status, author, email, post_id, order_id, task_id', 'required'),
			array('status, create_time, post_id, order_id, task_id', 'numerical', 'integerOnly'=>true),
			array('author, email, url', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, status, create_time, author, email, url, post_id, order_id, task_id', 'safe', 'on'=>'search'),
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
			'post' => array(self::BELONGS_TO, 'TblPost', 'post_id'),
            'commentStatus' => array(self::BELONGS_TO, 'TblCommentStatus', 'status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Содержание',
			'status' => 'Статус',
			'create_time' => 'Время создания',
			'author' => 'Автор',
			'email' => 'Email',
			'url' => 'Url',
			'post_id' => 'Тест',
			'order_id' => 'Заказ',
			'task_id' => 'Задача',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('task_id',$this->task_id);
        if ($this->create_time)
            $criteria->addCondition( "`create_time` > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL ".$this->create_time." DAY))" );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'t.id DESC',
                        ),

		));
	}
}