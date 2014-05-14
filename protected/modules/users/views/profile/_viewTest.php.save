<?php
/* @var $this TestListController */
/* @var $data TestList */
?>

<div class="view">
        <?php echo '<div class="crop"><img align=left src="/images/icons/services-icon' . CHtml::encode($data->id) . '.png" /></div>'; ?>

	<?php echo '<div><b>' . CHtml::encode($data->name) . '</b>'; ?>
        <br />
	<br />
    <?php if (Yii::app()->user->name == 'admin') echo "- могут выполнить " . $data->testerCount . " человек"; ?> 
    <br/><br/>
    <?php echo CHtml::checkBox("mytest[".$data->id."]",
                        ($data->typeTester(array( 'condition' => 'user_id='.Yii::app()->user->getId()))) ? true:false); ?>
    Готов участвовать

	</div><div style="clear: both">&nbsp;</div>


</div>
