<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">

	<?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
		'class'=>'cid',
		'title'=>'Линк на комментарий',
	)); ?>
    
	<div class="time">
		<?php echo date('j.m.Y',$comment->create_time); ?>
	</div>
    
	<div class="author">
		<?php echo $comment->authorLink; ?> написал: 
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($comment->content)); ?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>