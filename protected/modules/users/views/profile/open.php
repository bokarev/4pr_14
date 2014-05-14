<?php

/**
 * View user orders
 * @var $orders
 */

$this->pageTitle=Yii::t('UsersModule.core', 'Мои открытые тесты');
?>
<h1 class="has_background"><?php echo Yii::t('UsersModule.core', 'Мои открытые тесты'); ?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
    <?php //TODO_WUD : ! [cabinet] open tests
        foreach($orders->getOrderIdsPaid() as $orderId)
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
//                  array(
//				'name'=>'id',
//				'type'=>'raw',
//				'value'=>'CHtml::link(CHtml::encode($data->id), array("/orders/cart/view", "secret_key"=>$data->secret_key))',
//		    ),
                    array(
			'name'=>'renderFullName',
			'type'=>'raw',
			'header'=>Yii::t('OrdersModule.admin', 'Тесты'),
                        'value'=>'CHtml::link(CHtml::encode($data->name), array("/users/profile/open", "test"=>$data->product_id))',
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
		$this->renderPartial('../../../../views/site/partCabinetMenu');
        ?>
      <div class="panel">
        <h5>Wiki помощь</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>
    </aside>
    <!-- End Sidebar -->   
</div>