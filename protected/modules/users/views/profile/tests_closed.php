<?php

/**
 * View user orders
 * @var $orders
 */

$this->pageTitle=Yii::t('UsersModule.core', 'Мои завершенные заказы');
?>
<h1 class="has_background"><?php echo Yii::t('UsersModule.core', 'Мои завершенные заказы'); ?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
    <?php
        foreach($orders->getOrderIdsPaidClosed() as $orderId)
	{
            $orders->id = $orderId['id'];
            echo 'Заказ № ' . $orderId['id'];
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'               => 'orderedProducts',
                'enableSorting'    => false,
                'enablePagination' => false,
                'dataProvider'     => $orders->getOrderedProducts(),
                'selectableRows'   => 0,
                'template'         => '{items}',
                'columns'          => array(
                    array(
			'name'=>'renderFullName',
			'type'=>'raw',
			'header'=>Yii::t('OrdersModule.admin', 'Тесты')
                    ),
                    'quantity',
                    // 'sku',
                    array(
                        'name'=>'price',
                        'value'=>'StoreProduct::formatPrice($data->price)'
                    ),
                ),
            ));
	}
               
    ?>      
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