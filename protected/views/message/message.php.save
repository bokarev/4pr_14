<?php
/* @var $this MessageController */
?>
<h3>Мои сообщения</h3>
  <div class="row">
    <div class="nine columns" role="content">
 
      <article>           
            <dl class="tabs">
            <dd class="active"><a href="#received_msg">Полученные сообщения</a></dd>
            <dd><a href="#send_msg">Отправленные сообщения</a></dd>
            <dd><a href="#new_msg">Отправить сообщение</a></dd>
            </dl>
            <ul class="tabs-content">
				<li <?php echo ($is_valid_form)?'class="active"':'';?> id="received_msgTab">    
              
				<?php  
					$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$messageDataProvider,
					'id'=>'msg-list-view',
					'itemView'=>'_viewMessages',
						'emptyText'=>' У Вас нет сообщений',                     
						'enablePagination'=>true,
						'summaryText'=>"Сообщений: {count}",
						)); 
				?>
				</li>  
				<li id="send_msgTab">
					<?php  
						$this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$sentMsgDataProvider,
						'id'=>'sent_msg-list-view',
						'itemView'=>'_viewSentMsg',
							'emptyText'=>'Вы не отправляли сообщения',                     
							'enablePagination'=>true,
							'summaryText'=>"Сообщений: {count}",
							)); 
					?>
				</li>
				<li <?php echo (!$is_valid_form)?'class="active"':'';?> id="new_msgTab">
					<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
				</li>
            </ul>
      </article>
    </div> 
    <aside class="three columns">
       <?php
		$this->renderPartial('/site/partCabinetMenu');
        ?>
      <div class="panel">
        <h5>Wiki помощь</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>
    </aside>
  </div>