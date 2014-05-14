<?php
/* @var $this ProjectsController */
/* @var $model Projects */

//$this->breadcrumbs=array(
//	'Projects'=>array('index'),
//	$model->title,
//);
//
//$this->menu=array(
//	array('label'=>'List Projects', 'url'=>array('index')),
//	array('label'=>'Create Projects', 'url'=>array('create')),
//	array('label'=>'Update Projects', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Projects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Projects', 'url'=>array('admin')),
//);
?>

<h1>View Projects #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'text',
		//'main_topic',
		'title',
		'brief',
		'code',
		'allow_comments',
		//'related_topics',
		'allow_votes',
		'meta_keywords',
		'meta_description',
		'id',
		'date_created',
		'date_updated',
		'author_id',
		'editor_id',
		'published',
		'published_version',
		'date_published',
		//'image',
	),
)); ?>
