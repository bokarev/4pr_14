<div>
<?php if (Yii::app()->user->checkAccess('admin')) : ?>
	<div class="wiki-controls">
		<?php echo CHtml::link(Yii::t('wiki', 'Edit'), array('edit', 'uid' => $page->getWikiUid()))?> |
		<?php echo CHtml::link(Yii::t('wiki', 'History'), array('history', 'uid' => $page->getWikiUid()))?>
	</div>
<?php endif; ?>
	<h1> <?php echo $page->page_uid ?></h1>
	<div class="wiki-text">
		<?php echo $text?>
	</div>

<?php if (Yii::app()->user->checkAccess('admin')) : ?>
	<div class="wiki-controls">
		<?php echo CHtml::link(Yii::t('wiki', 'Оглавление'), array('pageIndex'))?> |
		<?php echo CHtml::link(Yii::t('wiki', 'Edit'), array('edit', 'uid' => $page->getWikiUid()))?> |
		<?php echo CHtml::link(Yii::t('wiki', 'History'), array('history', 'uid' => $page->getWikiUid()))?>
	</div>
<?php endif; ?>
</div>