<?php
/* @var $this TestListController */
/* @var $model TestList */

$this->breadcrumbs=array(
	'Test Lists'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestList', 'url'=>array('index')),
	array('label'=>'Create TestList', 'url'=>array('create')),
	array('label'=>'View TestList', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TestList', 'url'=>array('admin')),
);
?>

<h1>Update TestList <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>