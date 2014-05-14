<?php

/**
 * @var UserProfile $profile
 * @var User $user
 * @var Controller $this
 */

$this->pageTitle = Yii::t('UsersModule.core','Регистрация');
?>

<h1 class="has_background"><?php echo Yii::t('UsersModule.core','Регистрация'); ?></h1>

<div class="login_box rc5">
	<div class="form wide">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-register-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary(array($user, $profile)); ?>
            
                <div class="row">
			<?php echo $form->labelEx($user,'role'); ?>
                        <?php echo $form->radioButton($user, 'role',array('value'=>'4','onclick'=>'javascript: $("#creator").hide("slow")')) . '<span style="color: #06c; padding: 5px; font-size: 22px">Клиент</span>'; ?>
                        <?php echo $form->radioButton($user,'role',array('value'=>'3', 'onclick'=>'javascript: $("#creator").show("slow")')) . '<span style="color: #06c; padding: 5px; font-size: 22px">Исполнитель</span>'; ?>                   

		</div>

		<div class="row">
			<?php echo $form->labelEx($user,'username'); ?>
			<?php echo $form->textField($user,'username'); ?>
		</div>           

		<div class="row">
			<?php echo $form->labelEx($user,'password'); ?>
			<?php echo $form->passwordField($user,'password'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($user,'email'); ?>
			<?php echo $form->textField($user,'email'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'full_name'); ?>
			<?php echo $form->textField($profile,'full_name'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'age'); ?>
			<?php echo $form->textField($profile,'age'); ?>
		</div>

		<div class="row">
			<?php $sex=array(1=>'Мужской',2=>'Женский');  ?>
			<?php echo $form->label($profile,'sex'); ?>
			<?php echo $form->DropDownList($profile,'sex', $sex, array('empty'=>'-выберите-')) ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'phone'); ?>
			<?php echo $form->textField($profile,'phone'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'skype'); ?>
			<?php echo $form->textField($profile,'skype'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'country_id'); ?>
			<?php echo $form->dropDownList($profile, 'country_id', CHtml::listData(Countries::model()->findAll(), 'country_id', 'name'),
					array(
					'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('register/cities'), //url to call.
					'update'=>'#city', //selector to update
					//'data'=>'js:javascript statement'
					//leave out the data key to pass all form values through
					)));
			 ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'city_id'); ?>
			<?php
				$data = array();
				if ($profile->city_id > 0)
				{
					$data = CHtml::listData(Cities::model()->findAll(), 'city_id', 'name');
				}
			?>
			<?php 
//TODO_PR : 4pr register 2 roles
                        echo $form->dropDownList($profile,'city_id', $data, array('id'=>'city') ); ?>
		</div>
            <div id="creator">
                <div class="row">
			<?php echo $form->labelEx($profile,'foreign'); ?>
			<?php echo $form->textField($profile,'foreign'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'education'); ?>
			<?php echo $form->textField($profile,'education'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'profession'); ?>
			<?php echo $form->textField($profile,'profession'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'occupation'); ?>
			<?php echo $form->textField($profile,'occupation'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'known_computer'); ?>
			<?php echo $form->textArea($profile,'known_computer', array('rows'=>50)); ?>
		</div>
                
		<div class="row">
			<?php echo $form->labelEx($profile,'income'); ?>
			<?php echo $form->textField($profile,'income'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'marital'); ?>
			<?php echo $form->textField($profile,'marital'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'have_auto'); ?>
			<?php echo $form->checkBox($profile,'have_auto'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'have_estate'); ?>
			<?php echo $form->checkBox($profile,'have_estate'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'food'); ?>
			<?php echo $form->textField($profile,'food'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'travel'); ?>
			<?php echo $form->textField($profile,'travel'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'hobby'); ?>
			<?php echo $form->textField($profile,'hobby'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'sport'); ?>
			<?php echo $form->textField($profile,'sport'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'have_children'); ?>
			<?php echo $form->textField($profile,'have_children'); ?>
		</div>


		<div class="row">
			<?php echo $form->labelEx($profile,'district_home'); ?>
			<?php echo $form->textField($profile,'district_home'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'district_work'); ?>
			<?php echo $form->textField($profile,'district_work'); ?>
		</div>
        </div>

		<div class="row buttons">
			<?php echo CHtml::submitButton(Yii::t('UsersModule.core', 'Отправить')); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::link(Yii::t('UsersModule.core', 'Авторизация'), array('login/login')) ?><br>
			<?php echo CHtml::link(Yii::t('UsersModule.core', 'Напомнить пароль'), array('/users/remind')) ?>
		</div>

		<?php $this->endWidget();
                if(!isset($_GET['tester']))echo '<script>$("#creator").hide()</script>';?>
	</div><!-- form -->
</div>
