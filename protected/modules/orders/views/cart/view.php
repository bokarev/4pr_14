<?php

/**
 * View order
 * @var Order $model
 */

$title = Yii::t('OrdersModule.core', 'Просмотр заказа #{id}', array('{id}'=>$model->id));
$this->pageTitle = $title;

?>

<h1 class="has_background"><?php echo $title; //TODO_WUD : ! [order] view order?></h1>

<div class="order_products">
	<table width="100%">
		<thead>
		<tr>
			<td></td>
			<!--<td>Количество</td>-->
			<td>Сумма</td>
		</tr>
		</thead>
		<tbody>
		<?php foreach($model->getOrderedProducts()->getData() as $product): ?>
		<tr>
			<td>
				<?php echo CHtml::openTag('h3') ?>
				<?php echo $product->getRenderFullName(false); ?>
				<?php echo CHtml::closeTag('h3') ?>

				<?php echo CHtml::openTag('span', array('class'=>'price')) ?>
				<?php echo StoreProduct::formatPrice(Yii::app()->currency->convert($product->price)) ?>
				<?php echo Yii::app()->currency->active->symbol; ?>
				<?php echo CHtml::closeTag('span') ?>
			</td>
			<!--<td>
				<?php echo $product->quantity ?>
			</td>-->
			<td>
				<?php echo StoreProduct::formatPrice(Yii::app()->currency->convert($product->price * $product->quantity)); ?>
				<?php echo Yii::app()->currency->active->symbol; ?>
			</td>
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>

	<div class="order_data mt10">
		<div class="user_data rc5">
			<h2><?php echo Yii::t('OrdersModule.core', 'Данные получателя') ?></h2>

			<div class="form wide">
				<div class="row">
					<?php echo CHtml::encode($model->user_name); ?>
				</div>
				<div class="row">
					<?php echo CHtml::encode($model->user_email); ?>
				</div>
				<br/>
				<div class="row">
					<?php echo CHtml::encode($model->user_comment); ?>
				</div>
			</div>
		</div>
	</div>

    <div class="order_data mt10">
        <div class="user_data rc5">
            <h2><?php echo Yii::t('OrdersModule.core', 'Требования к тестерам:') ?></h2>

            <div class="form wide">
                <div class="row">
                    <?php echo $model->getAttributeLabel('user_sex'); ?> :
                    <?php if     ($model->user_sex == '1') echo 'Мужской';
                          elseif ($model->user_sex == '2') echo 'Женский';
                    ?>
                </div>
                <div class="row">
                    <?php echo $model->getAttributeLabel('user_age'); ?> :
                    <?php echo OrderTesterAgeFilter::model()->findByPK($model->user_age)->title; ?>
                </div>
                <div class="row">
                        <?php echo $model->getAttributeLabel('user_city'); ?> :
                        <?php echo Cities::model()->findByPK($model->user_city)->name; ?>
                </div>
                <div class="row">
                        <?php echo $model->getAttributeLabel('user_country'); ?> :
                        <?php echo Countries::model()->findByPK($model->user_country)->name; ?>
                </div>
            </div>
        </div>
    </div>


	<?php if($model->paid!=1){
        foreach($model->deliveryMethod->paymentMethods as $payment): ?>
	<div class="order_data mt10 ">
		<div class="user_data rc5 activeHover">
			<h3><?php echo $payment->name ?></h3>
			<p><?php echo $payment->description ?></p>
			<p><?php echo $payment->renderPaymentForm($model) ?></p>
		</div>
	</div>
	<?php endforeach ?>


	<div class="recount">
		<span class="total">Всего к оплате:</span>
		<span id="total">
			<?php echo StoreProduct::formatPrice(Yii::app()->currency->convert($model->full_price)) ?>
			<?php echo Yii::app()->currency->active->symbol ?>
		</span>
	</div>
        <?php } ?>
	<div style="clear: both;"></div>

</div>
