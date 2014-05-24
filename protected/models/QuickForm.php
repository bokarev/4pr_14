<?php  

class QuickForm extends CFormModel
{
    public $name;
    public $url;
    public $email;
    public $phone;
    public $message='Добрый день';
  
    public function rules()
    {
        return array(
            array('email, message', 'required'),
            array('phone, url', 'safe'),
        );
    }
  

    public function attributeLabels()
    {
        return array(
            'name'=>'Ваше имя',
            'phone'=>'Телефон',
            'email'=>'Email',
            'message'=>'Опишите задачу',
        );
    }
}
