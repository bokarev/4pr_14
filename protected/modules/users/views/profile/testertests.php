<?php

/**
 * View user orders
 * @var $orders
 */

$this->pageTitle=Yii::t('UsersModule.core', 'Назначенные тесты');
?>
<h1 class="has_background"><?php echo Yii::t('UsersModule.core', 'Назначенные тесты'); ?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
    <?php foreach($tests as $test){ ?>
                  <div class="six columns">
                    <a href="<?php echo '/users/profile/tests?id=' . $test['product_id'] . '&order=' . $test['order_id']; ?>">
                        <div class="panel radius callout" align="center" style="height:30px; border-color: #5ab4c5; margin-top:15px; line-height:0; background: #6bc5d6">
                         <strong>
                                 <?php echo $test['name']; ?>
                         </strong>
                        </div>
                    </a>
                </div> 
     <?php } ?>      
   </div>
   <aside class="three columns">
       <?php    
		$this->renderPartial('../../../../views/site/partCabinetMenu', array(
                        'user'=>$user, 
		));
        ?>
      <div class="panel">
        <h5>Wiki помощь</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>
    </aside>
    <!-- End Sidebar -->   
</div>