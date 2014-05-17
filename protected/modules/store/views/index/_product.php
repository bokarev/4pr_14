<li class="span3">
        <figure class="circle">
	<?php                
//TODO_WUD : ! [index] first page vitrine
                echo '<div class="services-icon' . $data->type_id . '"></div><h4>' . CHtml::encode($data->type) . '</h4>';            
				//echo CHtml::form(array('/orders/cart/add'));
				echo CHtml::hiddenField('product_id', $data->id);
				echo CHtml::hiddenField('product_price', $data->price);
				echo CHtml::hiddenField('use_configurations', $data->use_configurations);
				echo CHtml::hiddenField('currency_rate', Yii::app()->currency->active->rate);
				echo CHtml::hiddenField('configurable_id', 0);
				echo CHtml::hiddenField('quantity', 1);
			        echo CHtml::link('<img src ="images/arrow_up.jpg" style="margin-top: -18px" />', array('frontProduct/view', 'url'=>$data->url));
//                                echo CHtml::ajaxSubmitButton(Yii::t('StoreModule.core','заказ'), array('/orders/cart/add'), array(
//                                    'id'=>'addProduct' . $data->id,
//                                    'dataType'=>'json',
//                                    'success'=>'js:function(data, textStatus, jqXHR){processCartResponseFromList(data, textStatus, jqXHR, "'.Yii::app()->createAbsoluteUrl('/store/frontProduct/view', array('url'=>$data->url)).'")}',
//				));      
                                //echo CHtml::endForm();
        ?>
        </figure>
	<div class="name">
		<?php echo CHtml::link(CHtml::encode($data->name), array('frontProduct/view', 'url'=>$data->url)) ?>
	</div>
<!--<div class="price">
	<?php 
//TODO_PR : index page - commit buttons compare and wish list for vitrine on first page 
		if($data->appliedDiscount)
			echo '<span style="color:red; "><s>'.$data->toCurrentCurrency('originalPrice').'</s></span>';
	?>
	<?php echo $data->priceRange() ?>	
            <button class="small_silver_button" title="<?=Yii::t('core','Сравнить')?>" onclick="return addProductToCompare(<?php echo $data->id ?>);"><span class="compare">&nbsp</span></button>
            <button class="small_silver_button" title="<?=Yii::t('core','В список желаний')?>" onclick="return addProductToWishList(<?php echo $data->id ?>);"><span class="heart">&nbsp;</span></button>
	</div>
 -->
</li>