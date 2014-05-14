<div>
    <?php 
                if($user->role!=3){ //видео добавляют только тестеры role = 3
                    $type='Да [Текст]';
                    $but_text = 'Добавить комментарий к задаче';
                }else{
                    $but_text = 'Добавить ответ к задаче';
                }
                if($task==0)$but_text = 'Добавить комментарий к тесту';
                if($type=='Да [Видео]'){
 
                                    echo '<a href="javascript:$(\'#task_' . $task . '\').toggle(\'slow\');">
                                                <div class="panel radius callout" align="center" style="height:30px; line-height:0;">
                                                    <strong>Добавить видео из YouTube к задаче</strong>
                                                </div>
                                            </a>';    
                }
                if($type=='Да [Текст]'){
                                    echo '<a href="javascript:$(\'#task_' . $task . '\').toggle(\'slow\')">
                                    <div class="panel radius callout" align="center" style="height:30px; border-color: #a4b546; line-height:0; background: #afc14c">
                                        <strong>' . $but_text . '</strong>
                                    </div></a>';    
                }
                ?>
                    
 <div class="form" id="task_<?php echo $task ?>" style="display : <?php echo (!$type? 'visible' : 'none'); ?>">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment_form_' . $task,
	'enableAjaxValidation'=>true,
)); //TODO_WUD : ! [comment] form     
  echo $model->getStatus() ;
?>
  

	<div class="row">
		<?php echo $form->hiddenField($model,'author',array('size'=>60, 'value'=>Yii::app()->user->username)); ?>
	</div>
       	<div class="row">
		<?php echo $form->hiddenField($model,'order_id',array('size'=>60, 'value'=>$order)); ?>
	</div>
        <div class="row">
		<?php echo $form->hiddenField($model,'task_id',array('size'=>60, 'value'=>$task)); ?>
	</div>
     
       <div class="row">
		<?php
                if($user->role==3 or $user->role=='' or $user->role==4)
                    $status = 1;
                else
                    $status = 2;

                echo $form->hiddenField($model,'status',array('size'=>60, 'value'=>$status)); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'email',array('value'=>Yii::app()->user->email)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php                
                if($type=='Да [Видео]'){
                    echo $form->labelEx($model,'video');
                    echo $form->textArea($model,'content',array('rows'=>8, 'cols'=>50, 'style'=>'width:350px;'));
                }else{
                    echo $form->labelEx($model,'content');
                    echo $form->textArea($model,'content',array('style'=>'width:700px;height:200px'));
                }
                 ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Save'); ?>
	</div>

<?php $this->endWidget(); 
     
if(!$type){  //отдельно вызывается форма только для случая с видео в задаче 0 (ко всему тесту)
             //todo - оптимизировать
    
?>
     <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment_form_' . $task,
	'enableAjaxValidation'=>true,
)); //TODO_WUD : ! [comment] form                                       
?>
    

	<div class="row">
		<?php echo $form->hiddenField($model,'author',array('size'=>60, 'value'=>Yii::app()->user->username)); ?>
	</div>
       	<div class="row">
		<?php echo $form->hiddenField($model,'order_id',array('size'=>60, 'value'=>$order)); ?>
	</div>
        <div class="row">
		<?php echo $form->hiddenField($model,'task_id',array('size'=>60, 'value'=>$task)); ?>
	</div>
     
        <div class="row">
		<?php
                if($user->role==3 or $user->role=='' or $user->role==4)
                    $status = 1;
                else
                    $status = 2;

                echo $form->hiddenField($model,'status',array('size'=>60, 'value'=>$status)); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'email',array('value'=>Yii::app()->user->email)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php                
                    echo $form->labelEx($model,'video');
                    echo $form->textArea($model,'content',array('rows'=>8, 'cols'=>50, 'style'=>'width:350px;'));

                 ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Save'); ?>
	</div>

<?php $this->endWidget(); 
    
    
}
?>
<br /><br />
</div><!-- form -->                   
                    
                <?php
                if($comments){
                    $this->renderPartial('_comments',array(
			'post'=>$model,
			'comments'=>$comments, 
                        'task'=>$task,
                    ));                     
                }

    ?>
<br /><br />
</div>
