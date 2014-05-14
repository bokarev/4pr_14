<h1 class="has_background"><?php
    echo  CHtml::encode('Активность пользователей');
?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
        <?php
/* @var $this TblCommentController */
/* @var $model TblComment */

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



<h1>Просмотр комментария №<?php echo $model->id; ?> <?php echo CHtml::link('редактировать', '/testComment/update/' . $model->id); ?></h1>

<?php 
        switch ($model->status) {
    case 1:
        $status = "ожидает рассмотрения";
        break;
    case 2:
        $status = "одобрено";
        break;
    case 3:
        $status = "одобрено с отключенными комментариями";
        break;
    case 4:
        $status = "отклонено";
        break;
    case 5:
        $status = "отправлено на доработку";
        break;
    default : 
        $status = "не определен";
        }
        $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
                 array( 'type'=>'raw',
                        'name'=>'status',
                        'value'=>$status,
			),
		 array( 'type'=>'raw',
                        'name'=>'create_time',
                        'value'=>date( "H:i d F", $model->create_time ),
			),
		'author',
		'email',
                array( 'type'=>'raw',
                        'name'=>'Линк',
                        'value'=>CHtml::link( "просмотр теста", array('users/profile/tests','id'=>substr($model->post_id, strlen($model->order_id)),'order'=>$model->order_id ) ),
			),
		'post_id',
		'order_id', 
		'task_id',
	),
)); 
?>



<?php               $comment = $model;
                    if(substr_count(CHtml::encode($comment->content), 'youtube.com/watch')==1)
                    {
                        if(substr_count(CHtml::encode($comment->content), 'list')==1){
                            $comment->content = preg_replace('/.*list=([^&]*)&.*/', '$1', $comment->content);
                            $comment->content = '<iframe width="706" height="397" src="//www.youtube.com/embed/?listType=playlist&list=' . $comment->content . '&showinfo=1" frameborder="0" allowfullscreen></iframe>';                   
                        }else{
                            $comment->content = str_replace('http://youtube.com','http://www.youtube.com',$comment->content);
                            $comment->content = str_replace('http://www.youtube.com/watch?v=', '<iframe width="706" height="397" src="http://www.youtube.com/embed/', $comment->content);
                            $comment->content .= '" frameborder="0" allowfullscreen></iframe>';
                        }                       
                        echo $comment->content;                       
                    }
//                    else 
//                        echo  nl2br(CHtml::encode($comment->content));
?>

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