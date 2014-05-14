<?php
/* @var $this TestListController */
/* @var $data TestList */
?>

<div class="view">
        <?php echo CHtml::link('<img align=left src="/images/tests/test_' . CHtml::encode($data->id) . '.gif" />', array('view', 'id'=>$data->id)); ?>

	<?php echo CHtml::encode($data->name); ?>
        <br />
    - могут выпонить <?php echo $data->testerCount; ?> человек
        <br /><br />
    <?php
    $user = User::model()->findByPk( Yii::app()->user->getId() );
    if (!Yii::app()->user->isGuest)
    {
        if($user->role==1){
            $output = '';
            foreach($data->testers as $tester)
                $output .= ', ' . $tester->username;

            echo substr($output, 2);
        }
    }
    ?>

    <div style="clear: both">&nbsp;</div>

</div>
