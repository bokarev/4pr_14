<?php
/* @var $this ProjectsController */
/* @var $data Projects */
?>

<div class="view">
        	
	<b><?php echo CHtml::link(CHtml::encode($data->title), array('viewProjects', 'id'=>$data->id)); ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_topic')); ?>:</b>
	<?php echo CHtml::encode($data->main_topic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brief')); ?>:</b>
	<?php echo CHtml::encode($data->brief); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_comments')); ?>:</b>
	<?php echo CHtml::encode($data->allow_comments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('related_topics')); ?>:</b>
	<?php echo CHtml::encode($data->related_topics); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_votes')); ?>:</b>
	<?php echo CHtml::encode($data->allow_votes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->meta_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_description')); ?>:</b>
	<?php echo CHtml::encode($data->meta_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_updated')); ?>:</b>
	<?php echo CHtml::encode($data->date_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('editor_id')); ?>:</b>
	<?php echo CHtml::encode($data->editor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode($data->published); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published_version')); ?>:</b>
	<?php echo CHtml::encode($data->published_version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_published')); ?>:</b>
	<?php echo CHtml::encode($data->date_published); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	*/ ?>

</div>