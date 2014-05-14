<?php
class MessageForm extends CFormModel
{
	public $receiver;
	public $msg;

	public function rules()
	{
		return array(
			array('receiver, msg', 'required'),
			array('msg','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
		);
	}
	public function attributeLabels()
	{
		return array(
			'receiver'=>'Получатели',
			'msg'=>'Сообщение'
		);
	}
	
	public static function usersList()
	{
		$users = Yii::app()->db->createCommand()
				->select('id, username')
				->from(User::model()->tablename())
				->where('id<>:uid', array(':uid'=>Yii::app()->user->id))
				->queryAll();
		
		return CHtml::listData($users, 'id', 'username');
	}
}