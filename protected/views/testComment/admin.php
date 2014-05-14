<h1 class="has_background"><?php
    echo  CHtml::encode('Активность пользователей');
?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
        <?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbl-comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Последнии комментарии к тестам</h1>

<p>
Вы можете использовать операторы сравнения в фильтрах (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>)
</p>

<?php echo CHtml::link('Продвинутый поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tbl-comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'content',
         array('type'=>'raw',
               'name'=>'status',
		       'value'=>'$data->commentStatus->title',
               'filter'=>CHtml::listData(TblCommentStatus::model()->findAll(), 'id', 'title'),
			),
		 array('type'=>'raw',
		       'name'=>'create_time',
		       'filter' => array( '1' => 'За сегодня', '3' => 'За три дня', '7'=>'За неделю', '14' => 'За две недели', '30'=>'За месяц'),
		       'value'=>'date( "H:i d F", $data->create_time )',
			),
		'author',
		'email',
		/*
		'url',
		'post_id',
		'order_id',
		'task_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
   </div>
   <aside class="three columns">
       <?php
		$this->renderPartial('../../views/site/partCabinetMenu', array(
                        'user'=>$user,
		));
        ?>
      
    </aside>
    <!-- End Sidebar -->
</div>