<?php

/**
 * View user tests
 * @var $test
 */
if($test)
    $this->pageTitle=Yii::t('UsersModule.core', CHtml::encode($test->name));
else
    $this->pageTitle=Yii::t('UsersModule.core', 'Мои открытые тесты');
?>

<script language="JavaScript">
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  $(document).ready(function(){
      $('#sortable').sortable({
          update: function(event, ui) {
              var newOrder = $(this).sortable('toArray').toString();
              $.get('saveSortable.php', {order:newOrder});
          }
      });
  });
</script>

<h1 class="has_background"><?php
if($test)
    echo Yii::t('UsersModule.core', CHtml::encode($test->name) . ' (' . CHtml::encode($test->type) . ')');
else
    echo Yii::t('UsersModule.core', CHtml::encode('Мои открытые тесты'));
?></h1>
<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">

<?php //TODO_WUD : ! [cabinet] open tests
        if($test){

            echo '<div class="products_list">' .
            '<ul class="services-block clearfix">' .
            '<li class="span3"><figure class="circle">' .
            '<div class="services-icon' . $test->type_id . '"></div><h4>' .
            '<b>' . $test->name . '</b></br>Тип теста:<br /><b>' .
            CHtml::encode($test->type) . '</b>' .
            '<br />Исполнитель: <br /><b>';

            if ($orderProduct->status_id!=0)
                echo 'не выбран';
            elseif ($orderProduct->status_id==1)
                echo $tester->username ;

            echo '</b></h4></figure></li>' .
            '</ul></div>';



            if ($orderProduct->status_id==0) {
                echo CHtml::form();
                echo CHtml::openTag('div', array('class'=>'row'));
                echo CHtml::DropDownList('status_id', $orderProduct->status_id, CHtml::listData(OrderProductStatus::model()->findAll(), 'status_id', 'value'), array('style'=>'width:250px'));
                echo CHtml::closeTag('div');
                echo CHtml::openTag('div', array('class'=>'row'));
                echo CHtml::submitButton('Сохранить');
                echo CHtml::endForm();
                echo CHtml::closeTag('div');
            }


?>

            <br/><br/>

<?php
$this->renderPartial('_view', array(
            'data'=>$model,
            ));
?>

<div id="comments">
	<?php

        if(Yii::app()->user->hasFlash('commentSubmitted')){ 
            
            ?>
		<div class="flash-success">
			<?php  
                        echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php }   
                $this->renderPartial('/comment/_form',array(
                        'task'=>0,
                        'order'=>$_GET['order'],
                        'type'=>false,
			'model'=>$comment,
                        'user'=>$user,
                        'comments'=>$model->comments,

                    ));
                ?>


</div>
        <br /><br /><!-- comments -->
            <h1 class="has_background" style="width:706px">Задачи теста</h1>
        <br /><br />

        <?php

            if($test->getEavAttributes())
            {
                $a = $this->widget('application.modules.store.widgets.SAttributesTableRenderer', array(
                    'model'=>$test,
                    'htmlOptions'=>array(
			'class'=>'attributes',

                    ),
                ));

                echo CHtml::openTag('ul', array('id'=>'sortable'));

                $c = 1;
                foreach($a->attrForm as $attr)
                {
                    echo '<li id="" class="ui-state-default" style="padding:5px; cursor: move">' . $attr['title'];
                    $this->renderPartial('/comment/_form',array(
                        'task'=>$c,
                        'order'=>$_GET['order'],
                        'type'=>$attr['value'],
                        'user'=>$user,
			'model'=>$comment,
                        'comments'=>$model->comments,

                    ));

					echo '</li>';

                    $c++;
                }
                echo CHtml::closeTag('ul');
            }

        }else{

        foreach($orders->getOrderIdsPaid() as $orderId)
	{
            $orders->id = $orderId['id'];
            // echo 'Заказ № ' . $orderId['id'];
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
			'header'=>Yii::t('OrdersModule.admin', 'Заказ № ' . $orderId['id']),
                        'value'=>'CHtml::link(CHtml::encode($data->name), array("/users/profile/tests", "id"=>$data->product_id, "order"=>' . $orderId['id'] . '))',
                    ),
                ),
            ));
	}
        }
        echo '<br /><br />';

    ?>
   </div>
   <aside class="three columns">
       <?php
		$this->renderPartial('../../../../views/site/partCabinetMenu', array(
                        'user'=>$user,
		));
        ?>
      <div class="panel">
        <div>
            <?php
        if($test){
            echo "<h4><b>Мои открытые тесты</b></h4>";
        foreach($orders->getOrderIdsPaid() as $orderId)
	{ 
            $orders->id = $orderId['id'];
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
			'header'=>Yii::t('OrdersModule.admin', 'Заказ № ' . $orderId['id']),
                        'value'=>'CHtml::link(CHtml::encode($data->name), array("/users/profile/tests", "id"=>$data->product_id, "order"=>' . $orderId['id'] . '))',
                    ),

                ),
            ));
	}
        }
            ?>

          </div>
        <h5>Совет</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>
    </aside>
    <!-- End Sidebar -->
</div>