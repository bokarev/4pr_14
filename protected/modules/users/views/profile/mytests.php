<?php

/**
 * View user orders
 * @var $orders
 */

$this->pageTitle=Yii::t('UsersModule.core', 'Заявки на проекты');
?>
<h1 class="has_background"><?php echo Yii::t('UsersModule.core', 'Заявки на проекты'); ?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
    <?php echo CHtml::beginForm(); ?>

        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_viewTest',
        )); ?>
     <?php echo CHtml::submitButton('Сохранить'); ?>
     <?php echo CHtml::endForm(); ?>
   </div>
   <aside class="three columns">

       <?php
		$this->renderPartial('../../../../views/site/partCabinetMenu', array(
                        'user'=>$user,
		));
        ?>

            <div class="panel">
        <h5>Совет</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>

    </aside>

    <!-- End Sidebar -->


</div>