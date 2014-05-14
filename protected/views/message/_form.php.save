<?php  
    	$form=$this->beginWidget('foundation.widgets.FounActiveForm', array(
         'id'=>'message-form',
	'type'=>'nice'
    )); ?>

	<?php echo $form->dropDownListRow($model, "receiver", MessageForm::usersList(),array('multiple'=>'multiple')); ?>    
	<?php echo $form->textAreaRow($model, "msg", array('rows'=>15)); ?> 
	<?php echo CHtml::submitButton('Отправить', array('class'=>'small green button radius'));?>

 <?php $this->endWidget(); ?>