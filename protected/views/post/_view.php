<div class="post" style="font-size: 24px;">
<?php if (Yii::app()->user->name == 'admin') { ?>
	<div style="width: 300px; float:right">
		<div id="sidebar">
    <ul>
	<li><?php echo CHtml::link('Create New Post',array('post/create')); ?></li>
	<li><?php echo CHtml::link('Manage Posts',array('post/admin')); ?></li>
	<li><?php echo CHtml::link('Approve Comments',array('comment/index')) . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
	<li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
    </ul>
                </div><!-- sidebar -->
	</div>
<?php } ?>
	<div class="title" style="font-size: 32px">
		<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
	</div>
	<div class="author">
		опубликовано <?php echo date('j.m.Y',$data->create_time); ?>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
	</div>
	<div class="nav">
		<b>Теги:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
		<?php // echo CHtml::link('Permalink', $data->url); ?> 
		<?php echo CHtml::link("Комментарии ({$data->commentCount})",$data->url.'#comments'); ?> 
	</div>
</div>
