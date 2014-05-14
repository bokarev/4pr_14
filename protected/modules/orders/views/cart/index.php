<?php

/**
 * Display cart
 * @var Controller $this
 * @var SCart $cart
 * @var $totalPrice integer
 */

Yii::import('application.modules.users.*');
Yii::import('application.modules.users.forms.UserLoginForm');
Yii::import('application.modules.users.models.*');

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/cart.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('cartScript', "var orderTotalPrice = '$totalPrice';", CClientScript::POS_HEAD);

$this->pageTitle = Yii::t('OrdersModule.core', 'Оформление заказа');

if(empty($items))
{
	echo CHtml::openTag('h2');
	echo Yii::t('OrdersModule.core', 'Корзина пуста');
	echo CHtml::closeTag('h2');
	return;
}
?>

<h1 class="has_background"><?php echo Yii::t('OrdersModule.core', 'Оформление заказа') ?></h1>

<?php echo CHtml::form() ?>
<div class="order_products">
	<table width="100%">
		<thead>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<!--<td>Количество</td>-->
			<td>Сумма</td>
		</tr>
		</thead>
		<tbody>
		<?php foreach($items as $index=>$product): ?>
		<tr>
			<td style="vertical-align:middle;" width="20px">
				<?php echo CHtml::link('&nbsp;', array('/orders/cart/remove', 'index'=>$index), array('class'=>'remove')) ?>
			</td>
			<td width="110px" align="center">
				<?php
					// Display image
					if($product['model']->mainImage)
						$imgSource = $product['model']->mainImage->getUrl('100x100');
					else
						$imgSource = 'http://placehold.it/100x100';
					echo CHtml::image($imgSource, '', array('class'=>'thumbnail'));
				?>
			</td>
			<td>
				<?php
					$price = StoreProduct::calculatePrices($product['model'], $product['variant_models'], $product['configurable_id']);

					// Display product name with its variants and configurations
					echo CHtml::link(CHtml::encode($product['model']->name), array('/store/frontProduct/view', 'url'=>$product['model']->url)).'<br/>';

					// Price
					echo CHtml::openTag('span', array('class'=>'price'));
					echo StoreProduct::formatPrice(Yii::app()->currency->convert($price));
					echo ' '.Yii::app()->currency->active->symbol;
					echo CHtml::closeTag('span');

					// Display variant options
					if(!empty($product['variant_models']))
					{
						echo CHtml::openTag('span', array('class'=>'cartProductOptions'));
						foreach($product['variant_models'] as $variant)
							echo ' - '.$variant->attribute->title.': '.$variant->option->value.'<br/>';
						echo CHtml::closeTag('span');
					}

					// Display configurable options
					if(isset($product['configurable_model']))
					{
						$attributeModels = StoreAttribute::model()->findAllByPk($product['model']->configurable_attributes);
						echo CHtml::openTag('span', array('class'=>'cartProductOptions'));
						foreach($attributeModels as $attribute)
						{
-							$method = 'eav_'.$attribute->name;
							echo ' - '.$attribute->title.': '.$product['configurable_model']->$method.'<br/>';
						}
						echo CHtml::closeTag('span');
					}
				?>
			</td>
			<!--<td>
				<?php echo CHtml::textField("quantities[$index]", $product['quantity'], array('class'=>'count')) ?>
			</td>-->
			<td>
				<?php
				echo CHtml::openTag('span', array('class'=>'price'));
				echo StoreProduct::formatPrice(Yii::app()->currency->convert($price * $product['quantity']));
				echo ' '.Yii::app()->currency->active->symbol;
				echo CHtml::closeTag('span');
				?>
			</td>
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>

	<div class="recount">
		<span class="total">Всего:</span>
		<span id="total">
			<?php echo StoreProduct::formatPrice($totalPrice) ?>
			<?php echo Yii::app()->currency->active->symbol ?>
		</span>
	</div>

</div>

<?php if(Yii::app()->user->isGuest) : ?>
</form>

<?php $model = new UserLoginForm; //hardcode // ?>
<?php $this->renderFile(Yii::getPathOfAlias('users.views.login.login').'.php', array('model'=>$model, 'order'=> 1)); ?>

<?php else: ?>

<div class="order_data">
	<div class="user_data rc5">

		<h2><?php echo $this->form->name ?> : Задать вопрос</h2>

		<div class="form wide">
			<?php echo CHtml::errorSummary($this->form); ?>

			<?php echo CHtml::activeHiddenField($this->form,'name'); ?>
			<?php echo CHtml::activeHiddenField($this->form,'email'); ?>

			<div class="row">
				<?php echo CHtml::activeLabel($this->form,'comment'); ?>
				<?php echo CHtml::activeTextArea($this->form,'comment'); ?>
			</div>
            <div class="row">
                <label>Критерии подбора исполнителей:</label>
            </div>

            <div class="row">
                <?php $sex=array(1=>'Мужской',2=>'Женский');  ?>
                <?php echo CHtml::activeLabel($this->form,'user_sex'); ?>
                <?php echo CHtml::activeDropDownList($this->form,'user_sex', $sex, array('empty'=>'-не выбран-')) ?>
            </div>

            <div class="row">
                <?php echo CHtml::activeLabel($this->form,'user_age'); ?>
                <?php echo CHtml::activeDropDownList($this->form,'user_age', CHtml::listData(OrderTesterAgeFilter::model()->findAll(), 'filter_id', 'title')) ?>
            </div>

            <div class="row">
                <?php echo CHtml::activeLabel($this->form,'user_country'); ?>
                <?php echo CHtml::activedropDownList($this->form, 'user_country', CHtml::listData(Countries::model()->findAll(), 'country_id', 'name'),
                    array(
                        'ajax' => array(
                            'type'=>'POST', //request type
                            'url'=>CController::createUrl('/users/register/cities'), //url to call.
                            'update'=>'#city', //selector to update
                            //'data'=>'js:javascript statement'
                            //leave out the data key to pass all form values through
                        )));
                ?>
            </div>

            <div class="row">
                <?php echo CHtml::activelabelEx($this->form,'user_city'); ?>

                <?php echo CHtml::activedropDownList($this->form,'user_city', array() , array('id'=>'city') ); ?>
            </div>

		</div>
	</div>

</div>

<div style="clear:both;"></div>

<div class="has_background confirm_order">
	<h1>Всего к оплате:</h1>
	<span id="orderTotalPrice" class="total"><?php echo StoreProduct::formatPrice($totalPrice) ?></span>
	<span class="current_currency">
		<?php echo Yii::app()->currency->active->symbol; ?>
	</span>
	<button class="blue_button" type="submit" name="create" value="1">Заказать</button>
</div>

<?php echo CHtml::endForm() ?>

<?php endif; ?>