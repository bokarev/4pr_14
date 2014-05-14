<?php

/**
 * View user orders
 * @var $orders
 */

$this->pageTitle=Yii::t('UsersModule.core', 'Мои заказы');
?>
<h1 class="has_background"><?php echo Yii::t('UsersModule.core', 'Мои заказы'); ?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">
<?php
//TODO_WUD : ! [cabinet] orders

	 $this->widget('zii.widgets.grid.CGridView', array(
		'id'           => 'ordersListGrid',
		'dataProvider' => $orders->search(),
		'template'     => '{items}',
		'columns' => array(
			array(
				'name'=>'id',
				'type'=>'raw',
				'value'=>'CHtml::link(CHtml::encode($data->id), array("/orders/cart/view", "secret_key"=>$data->secret_key))',
			),
			'user_email',
                    	//'skype',
			'user_phone',
			array(
				'name'=>'status_id',
				'filter'=>CHtml::listData(OrderStatus::model()->orderByPosition()->findAll(), 'id', 'name'),
				'value'=>'$data->status_name'
			),

                        array(
				'type'=>'raw',
				'name'=>'paid',
				'value'=>'($data->paid==0?"нет " . CHtml::link(CHtml::encode("оплатить"), array("/orders/cart/view", "secret_key"=>$data->secret_key)):"да")',
			),
                       'created',
			array(
				'type'=>'raw',
				'name'=>'full_price',
				'value'=>'StoreProduct::formatPrice($data->full_price)',
			),
		),
	));
        
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