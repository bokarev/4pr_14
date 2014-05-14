<?php

class Comment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_comment':
	 * @var integer $id
	 * @var string $content
	 * @var integer $status
	 * @var integer $create_time
	 * @var string $author
	 * @var string $email
	 * @var string $url
	 * @var integer $post_id
	 */
	const STATUS_PENDING=1;
	const STATUS_APPROVED=2;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
			array('content, author, email', 'required'),
			array('author, email, url', 'length', 'max'=>128),
			array('email','email'),
                        array('order_id, status, task_id', 'numerical', 'integerOnly'=>true),
			array('url','url'),
		);
	}
        
        public function getStatus()
	{       
		return ;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
            'commentStatus' => array(self::BELONGS_TO, 'TblCommentStatus', 'status'),
		);
	}
        
        /**
	 * @return integer
	 */
	public function getTask()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return 'task_id' ;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'content' => 'Добавить ответ',
			'status' => 'Статус',
			'create_time' => 'Дата создания',
			'author' => 'Ваше имя',
			'email' => 'Email',
			'url' => 'Сайт (если есть)',
			'video' => 'Введите адрес страницы видео на Youtube, например <pre>http://www.youtube.com/watch?v=dmWOFnfllms</pre>' .
                        'или адрес страницы с плейлистом, например <pre>http://www.youtube.com/watch?v=qLs47t4ROw8&list=PLVBkQAPTrCOpOh1aNUbEi7lSiAWzOpkyr&index=4</pre>',
		);
	}

	/**
	 * Approves a comment.
	 */
	public function approve()
	{
		$this->status=Comment::STATUS_APPROVED;
		$this->update(array('status'));
	}

	/**
	 * @param Post the post that this comment belongs to. If null, the method
	 * will query for the post.
	 * @return string the permalink URL for this comment
	 */
	public function getUrl($post=null)
	{
		if($post===null)
			$post=$this->post;
		return $post->url.'#c'.$this->id;
	}

	/**
	 * @return string the hyperlink display for the current comment's author
	 */
	public function getAuthorLink()
	{
		if(!empty($this->url))
			return CHtml::link(CHtml::encode($this->author),$this->url);
		else
			return CHtml::encode($this->author);
	}

	/**
	 * @return integer the number of comments that are pending approval
	 */
	public function getPendingCommentCount()
	{
		return $this->count('status='.self::STATUS_PENDING);
	}

	/**
	 * @param integer the maximum number of comments that should be returned
	 * @return array the most recently added comments
	 */
	public function findRecentComments($limit=10)
	{
		return $this->with('post')->findAll(array(
			'condition'=>'t.status='.self::STATUS_APPROVED,
			'order'=>'t.create_time DESC',
			'limit'=>$limit,
		));
	}
        
        public function oldContent()
	{
		$content =   Yii::app()->db->createCommand()
				->select('content')
				->from('tbl_comment')
				->where('post_id=:post_id', array(
					':post_id'=>$this->post_id
				))
                                ->order('create_time DESC')
                                ->limit(1)
				->queryColumn();
                if(count($content))return $content[0];
                else return false;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{       $oldContent = self::oldContent();
                        if($oldContent and $oldContent==$this->content){
                            Yii::app()->request->redirect('/users/profile/tests?id=' . $_GET['id'] . '&order='  . $_GET['order']);
                            return false;                
                        }
			if($this->isNewRecord)
				$this->create_time=time();
			return true;
		}
		else
			return false;
	}
}