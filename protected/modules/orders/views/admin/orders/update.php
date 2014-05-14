<?php
Yii::import('application.modules.users.models.*');

/**
 * Update order
 *
 * @var $model Order
 * @var $this OrdersController
 */

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/admin/orders.update.js', CClientScript::POS_END);

$template= array('history_back','save','dropDown');
if($model->isNewRecord===false)
	$template[]='delete';

$this->topButtons = $this->widget('admin.widgets.SAdminTopButtons', array(
	'formId'=>'orderUpdateForm',
	'template'=>$template,
	'deleteAction'=>$this->createUrl('/orders/admin/orders/delete', array('id'=>$model->id)),
	'updateAction'=>'update'
));

$title = ($model->isNewRecord) ? Yii::t('OrdersModule.admin', 'Создание заказа') :
	Yii::t('OrdersModule.admin', 'Редактирование заказа');

$this->breadcrumbs = array(
	'Home'=>$this->createUrl('/admin'),
	Yii::t('OrdersModule.admin', 'Заказы')=>$this->createUrl('index'),
	($model->isNewRecord) ? Yii::t('OrdersModule.admin', 'Создание заказа') :'# '.CHtml::encode($model->id),
);

$this->pageHeader = $title;

$this->widget('admin.widgets.schosen.SChosen', array(
	'elements'=>array('Order_delivery_id', 'Order_status_id')
));

// register all delivery methods to recalculate prices
Yii::app()->clientScript->registerScript('deliveryMetohds', strtr('
	var deliveryMethods = {data};
', array(
	'{data}'=>CJavaScript::jsonEncode($deliveryMethods)
)), CClientScript::POS_END);

?>

<style type="text/css">
	div.userData input[type=text] {
		width: 400px;
	}
	div.userData textarea {
		width: 403px;
	}
	#orderedProducts {
		padding: 0 0 5px 0;
	}
	.ui-dialog .ui-dialog-content {
		padding: 0;
	}
	#dialog-modal .grid-view {
		padding: 0;
	}
	#orderSummaryTable tr td {
		padding: 3px;
	}
</style>

<div class="form wide padding-all">
		<?php
			if($model->isNewRecord)
				$action='create';
			else
				$action='update';
			echo CHtml::form($this->createUrl($action, array('id'=>$model->id)), 'post', array('id'=>'orderUpdateForm'));

			if($model->hasErrors())
				echo CHtml::errorSummary($model);
		?>
		<table width="100%">
			<tr valign="top">
				<td width="50%">
					<!-- User data -->
					<div class="userData">
						<h4><?php echo Yii::t('OrdersModule.admin', 'Данные пользователя'); ?></h4>
						<div class="row">
							<?php echo CHtml::activeLabel($model,'status_id', array('required'=>true)); ?>
							<?php echo CHtml::activeDropDownList($model, 'status_id', CHtml::listData($statuses, 'id', 'name')); ?>
						</div>

						<!--<div class="row">
							<?php echo CHtml::activeLabel($model,'delivery_id', array('required'=>true)); ?>
							<?php echo CHtml::activeDropDownList($model, 'delivery_id', CHtml::listData($deliveryMethods, 'id', 'name'), array(
								'onChange'=>'recountOrderTotalPrice(this)',
						)); ?>-->
						</div>

						<div class="row">
							<?php echo CHtml::activeLabel($model,'paid'); ?>
							<?php echo CHtml::activeCheckBox($model, 'paid'); ?>
						</div>

						<div class="row">
							<?php echo CHtml::activeLabel($model,'user_name', array('required'=>true)); ?>
							<?php echo CHtml::activeTextField($model,'user_name'); ?>
						</div>

						<div class="row">
							<?php echo CHtml::activeLabel($model,'user_email', array('required'=>true)); ?>
							<?php echo CHtml::activeTextField($model,'user_email'); ?>
						</div>

						<div class="row">
							<?php echo CHtml::activeLabel($model,'user_phone'); ?>
							<?php echo CHtml::activeTextField($model,'user_phone'); ?>
						</div>

						<!--<div class="row">
							<?php echo CHtml::activeLabel($model,'user_address'); ?>
							<?php echo CHtml::activeTextField($model,'user_address'); ?>
						</div>-->

						<div class="row">
							<?php echo CHtml::activeLabel($model,'user_comment'); ?>
							<?php echo CHtml::activeTextArea($model,'user_comment'); ?>
						</div>


                        <div class="row">
                            <label>Критерии подбора исполнителей:</label>
                        </div>

                        <div class="row">
                            <?php $sex=array(1=>'Мужской',2=>'Женский');  ?>
                            <?php echo CHtml::activeLabel($model,'user_sex'); ?>
                            <?php echo CHtml::activeDropDownList($model,'user_sex', $sex, array('empty'=>'-не выбран-')) ?>
                        </div>

                        <div class="row">
                            <?php echo CHtml::activeLabel($model,'user_age'); ?>
                            <?php echo CHtml::activeDropDownList($model,'user_age', CHtml::listData(OrderTesterAgeFilter::model()->findAll(), 'filter_id', 'title')) ?>
                        </div>

                        <div class="row">
                            <?php echo CHtml::activeLabel($model,'user_country'); ?>
                            <?php echo CHtml::activedropDownList($model, 'user_country', CHtml::listData(Countries::model()->findAll(), 'country_id', 'name'),
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
                            <?php
                                $data = array();

                                if ($model->user_country > 0) {
                                    $data = CHtml::listData( Cities::model()->findAllByAttributes( array ( 'country_id' => $model->user_country ) ), 'city_id', 'name');
                                }
                             ?>
                            <?php echo CHtml::activelabelEx($model,'user_city'); ?>
                            <?php echo CHtml::activedropDownList($model,'user_city', $data , array('id'=>'city') ); ?>
                        </div>

					</div>
				</td>
				<td>
					<!-- Right block -->
					<?php if(!$model->isNewRecord){ ?>
						<div style="float: right;padding-right: 10px">
							<a href="javascript:openAddProductDialog(<?php echo $model->id ?>);"><?php echo Yii::t('OrdersModule.admin','Добавить продукт') ?></a>
						</div>
						<div id="dialog-modal" style="display: none;" title="<?php echo Yii::t('OrdersModule.admin','Добавить продукт') ?>">
							<?php
							$this->renderPartial('_addProduct', array(
								'model'=>$model,
							));
							?>
						</div>

						<h4><?php echo Yii::t('OrdersModule.admin','Тесты'); ?></h4>

						<div id="orderedProducts">
							<?php
                                                        //echo $model->tableName();
							$this->renderPartial('_orderedProducts', array(
								'model'=>$model,
							));
							?>
						</div>
					<?php }?>

				</td>
			</tr>
		</table>
	<?php echo CHtml::endForm(); ?>
</div>