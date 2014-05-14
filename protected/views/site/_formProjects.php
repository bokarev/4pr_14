<?php
/* @var $this ProjectsController */
/* @var $model Projects */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
	$form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
		'id'=>'tests-form',
		'type'=>'nice'
	)); 
?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php 
		echo $form->errorSummary($model);
		echo $form->textAreaRow($model,'text',array('rows'=>6, 'cols'=>50));
		echo $form->textFieldRow($model,'main_topic',array('size'=>20,'maxlength'=>20));
		echo $form->textFieldRow($model,'title',array('size'=>60,'maxlength'=>255));
		echo $form->textAreaRow($model,'brief',array('rows'=>6, 'cols'=>50));
		echo $form->textFieldRow($model,'code',array('size'=>60,'maxlength'=>150));
		echo $form->textFieldRow($model,'allow_comments');
		echo $form->textAreaRow($model,'related_topics',array('rows'=>6, 'cols'=>50));
		echo $form->textFieldRow($model,'allow_votes');
		echo $form->textFieldRow($model,'meta_keywords',array('size'=>60,'maxlength'=>255));
		echo $form->textAreaRow($model,'meta_description',array('rows'=>6, 'cols'=>50));
		echo $form->textFieldRow($model,'date_created');
		echo $form->textFieldRow($model,'date_updated');
		echo $form->textFieldRow($model,'author_id',array('size'=>20,'maxlength'=>20));
		echo $form->textFieldRow($model,'editor_id',array('size'=>20,'maxlength'=>20));
		echo $form->textFieldRow($model,'published');
		echo $form->textFieldRow($model,'published_version',array('size'=>20,'maxlength'=>20));
		echo $form->textFieldRow($model,'date_published');
		echo $form->textFieldRow($model,'image',array('size'=>20,'maxlength'=>20));
		echo $form->checkBoxListRow($model, "relatedTests", TestList::getTestsList());  
		echo CHtml::submitButton('Отправить', array('class'=>'small green button radius'));
	$this->endWidget(); 

	echo CHtml::form(array('/site/delProject'), 'get');
	echo CHtml::hiddenField('id', $model->id);
	echo CHtml::submitButton('Удалить проект', array('class'=>'small red button radius'));
	echo CHtml::endForm();
?>


</div><!-- form -->