<?php

/**
 * This is the model class for table "sb_projects".
 *
 * The followings are the available columns in table 'sb_projects':
 * @property string $text
 * @property string $main_topic
 * @property string $title
 * @property string $brief
 * @property string $code
 * @property integer $allow_comments
 * @property string $related_topics
 * @property integer $allow_votes
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $id
 * @property string $date_created
 * @property string $date_updated
 * @property string $author_id
 * @property string $editor_id
 * @property integer $published
 * @property string $published_version
 * @property string $date_published
 * @property string $image
 */
class Projects extends CActiveRecord
{
	
	public $relatedTests;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Projects the static model class
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
		return 'sb_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, brief, related_topics, meta_description, author_id', 'required'),
			array('allow_comments, allow_votes, published', 'numerical', 'integerOnly'=>true),
			array('main_topic, author_id, editor_id, published_version, image', 'length', 'max'=>20),
			array('title, meta_keywords', 'length', 'max'=>255),
			array('code', 'length', 'max'=>150),
			array('date_created, date_updated, date_published, relatedTests', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('text, main_topic, title, brief, code, allow_comments, related_topics, allow_votes, meta_keywords, meta_description, id, date_created, date_updated, author_id, editor_id, published, published_version, date_published, image', 'safe', 'on'=>'search'),
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
			'text' => 'Text',
			'main_topic' => 'Main Topic',
			'title' => 'Title',
			'brief' => 'Brief',
			'code' => 'Code',
			'allow_comments' => 'Allow Comments',
			'related_topics' => 'Related Topics',
			'allow_votes' => 'Allow Votes',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'id' => 'ID',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'author_id' => 'Author',
			'editor_id' => 'Editor',
			'published' => 'Published',
			'published_version' => 'Published Version',
			'date_published' => 'Date Published',
			'image' => 'Image',
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

		$criteria->compare('text',$this->text,true);
		$criteria->compare('main_topic',$this->main_topic,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('allow_comments',$this->allow_comments);
		$criteria->compare('related_topics',$this->related_topics,true);
		$criteria->compare('allow_votes',$this->allow_votes);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('author_id',$this->author_id,true);
		$criteria->compare('editor_id',$this->editor_id,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('published_version',$this->published_version,true);
		$criteria->compare('date_published',$this->date_published,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getRelTestsId()
	{
		return Yii::app()->db->createCommand()
				->select('test_id')
				->from('sb_project_tests')
				->where('project_id=:pr_id', array(
					':pr_id'=>$this->id
				))
				->queryColumn();
	}
	
	public function saveRelTests($test_ids = array())
	{
		Yii::app()->db->createCommand()
				->delete('sb_project_tests', 'project_id=:pr_id', array(
					':pr_id'=>$this->id
				));
		if(empty($test_ids) || !is_array($test_ids)){return true;}
		$insert_values = array();
		foreach ($test_ids as $t){
			$insert_values[] = array(
				'project_id'=>$this->id,
				'test_id'=>$t,
				);
		}
		return Yii::app()->db->createCommand()
				->insert('sb_project_tests', $insert_values);
		
	}
	
	/*
	 * string $type (obj - ActiveRecord, array) return type data
	 * array $columns 
	 */
	public function getRelTests($type='array', $columns = '*')
	{
		$ids = Yii::app()->db->createCommand()
				->select('test_id')
				->from('sb_project_tests')
				->where('project_id=:pr_id', array(
					':pr_id'=>$this->id
				))
				->queryColumn();
		
		if(!in_array($type, array('obj', 'array')) || empty($ids)){return array();}
		
		$tests = array();
		if($type == 'obj')
		{
			$criteria = new CDbCriteria;
			$criteria->condition="id IN (".implode(',', $ids).")";
			$criteria->select = $columns;
			$tests = TestList::model()->findAll($criteria);
		}elseif($type == 'array'){
			if(is_array($columns)){$columns = implode(',', $columns);}
			$res = Yii::app()->db->createCommand()
					->select($columns)
					->from(TestList::model()->tableName())
					->where(array('in','id',$ids))
					->queryAll();
			
			foreach ($res as $t){
				$tests[$t['id']] = $t;
			}
		}
		
		return $tests;
	}
	
	public function getRelTestForListView()
	{
		$tests = $this->getRelTests();
		if(empty($tests)){return '-';}
		$res = '';
		foreach($tests as $t){
			$res[] = $t['title'];
		}
		return implode(', ', $res);
	}
	
	/*
	 * string $type (obj - ActiveRecord, array) return type data
	 * array $columns 
	 * bool $sort_by_test
	 */
	public function getRelTesters($type='array', $sort_by_test =false ,$columns = '*')
	{
		$relTesters = Yii::app()->db->createCommand()
				->select('user_id, project_id, test_id')
				->from('sb_tester_test')
				->where('project_id=:pr_id', array(
					':pr_id'=>$this->id,
				))
				->queryAll();
	
		$ids = null;
		foreach ($relTesters as $r){
			$ids[] = $r['user_id'];
		}
		
		if(!in_array($type, array('obj', 'array')) || empty($ids)){return array();}
		
		$testers = array();
		if($type == 'obj')
		{
			$criteria = new CDbCriteria;
			$criteria->condition="user_id IN (".implode(',', $ids).")";
			$criteria->select = $columns;
			$r_testers = Profile::model()->findAll($criteria);
		}elseif($type == 'array'){
			if(is_array($columns)){$columns = implode(',', $columns);}
			$r_testers = Yii::app()->db->createCommand()
					->select($columns)
					->from(Profile::model()->tableName())
					->where(array('in','user_id',$ids))
					->queryAll();
		}
		
		if(empty($sort_by_test)){return $r_testers;}
		
		$testers = array();
		foreach ($r_testers as $t){
			$testers[$t['user_id']] = $t;
		}
		
		$res = array();
		foreach($relTesters as $r)
		{
			$res[$r['test_id']][] = $testers[$r['user_id']];
		}
		
		return $res;
	}
}