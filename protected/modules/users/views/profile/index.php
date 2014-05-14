<?php

/**
 * @var $profile UserProfile
 * @var $user User
 * @var $form CActiveForm
 * @var $changePasswordForm ChangePasswordForm
 */

// Fancybox ext
$this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'a.thumbnail',
));

$this->pageTitle=Yii::t('UsersModule.core', 'Личный кабинет');
?>
<h3 class="has_background"><?php //TODO_WUD : ! [cabinet]

echo Yii::t('UsersModule.core', 'Личный кабинет');

?></h3>

<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">

    <div class="form wide padding-all">
	<?php

        $form=$this->beginWidget('CActiveForm', array( 'htmlOptions'=>array('enctype'=>'multipart/form-data') ) ); ?>

	<?php echo $form->errorSummary(array($profile, $user)); ?>

	<div class="row">
            
		<?php echo $form->label($profile,'full_name'); ?>
		<?php echo $form->textField($profile,'full_name') ?>
		<span class="required"> *</span>
	</div>

	<div class="row">
		<?php echo $form->label($user,'email'); ?>
		<?php echo $form->textField($user,'email') ?>
		<span class="required"> *</span>
	</div>
        
        <div class="row">
			<?php echo $form->labelEx($profile, 'image'); ?>
			<?php echo $form->fileField($profile,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($profile,'phone'); ?>
		<?php echo $form->textField($profile,'phone') ?>
	</div>


	<div class="row">
		<?php echo $form->label($profile,'skype'); ?>
		<?php echo $form->textField($profile,'skype') ?>
	</div>

	<div class="row">
		<?php $sex=array(1=>'Мужской',2=>'Женский');  ?>
		<?php echo $form->label($profile,'sex'); ?>
		<?php echo $form->DropDownList($profile,'sex', $sex, array('empty'=>'-выберите-')) ?>
	</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'age'); ?>
			<?php echo $form->textField($profile,'age'); ?>
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
			<?php echo $form->dropDownList($profile,'city_id', $data, array('id'=>'city') ); ?>
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
			<?php echo $form->checkBox($profile,'have_auto', array('value'=>1, 'uncheckValue'=>0)); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($profile,'have_estate'); ?>
			<?php echo $form->checkBox($profile,'have_estate', array('value'=>1, 'uncheckValue'=>0)); ?>
		</div>

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
			<?php echo $form->textField($profile,'known_computer'); ?>
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


	<div class="row submit">
		<label>&nbsp;</label>
		<?php echo CHtml::submitButton(Yii::t('UsersModule.admin', 'Сохранить')); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->

<div style="clear: both;"></div>

<div class="form wide padding-all">
	<?php $form=$this->beginWidget('CActiveForm'); ?>

	<?php echo $form->errorSummary($changePasswordForm); ?>

	<div class="row">
		<label></label>
		<b><?php echo Yii::t('UsersModule.admin', 'Изменить пароль'); ?></b>
	</div>

	<div class="row">
		<?php echo $form->label($changePasswordForm,'current_password'); ?>
		<?php echo $form->passwordField($changePasswordForm,'current_password') ?>
	</div>

	<div class="row">
		<?php echo $form->label($changePasswordForm,'new_password'); ?>
		<?php echo $form->passwordField($changePasswordForm,'new_password') ?>
	</div>

	<div class="row submit">
		<label>&nbsp;</label>
		<?php echo CHtml::submitButton(Yii::t('UsersModule.admin', 'Изменить')); ?>
	</div>

	<?php $this->endWidget(); ?>
    </div><!-- form -->
    </div>

    <!-- End Main Content -->
        <!-- Sidebar -->

    <aside class="three columns">
       <?php if ($profile->image <> ''): ?>
		    	<a class="thumbnail" href="<?php echo Yii::app()->params['storeImages']['userpicUrl'] . $profile->image; ?>"> <img src='<?php echo Yii::app()->params['storeImages']['userpicUrl'] . 'thumb_' . $profile->image; ?>'> </a>
       <?php endif; ?>
       <?php
		$this->renderPartial('../../../../views/site/partCabinetMenu',array(
                    'user'=>$user, 
                ));
                
                
        ?>

      <div class="panel">
        <h5>Совет</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>

    </aside>

    <!-- End Sidebar -->


</div>