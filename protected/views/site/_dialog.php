<?php
if($flashes = Yii::app()->user->getFlashes()) {
    foreach($flashes as $key => $message) {
        if($key != 'counters') {
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id'=>$key,
                        'options'=>array(
                            'show' => 'blind',
                            'hide' => 'explode',
                            'modal' => 'true',
                            'title' => $message['title'],
                            'autoOpen'=>true,
'dialogClass'=>$message['type'],
'buttons'=>array('Закрыть'=>'js:function() {$(this).dialog("close");}'),
'close'=>'js:function(e,ui){
                       $(this).dialog("destroy").remove();
                   }',
                        ),
'htmlOptions'=>array(
        'class'=>'flash-success',
),
                        ));

            printf('<span class="dialog">%s</span>', $message['content']);
            $this->endWidget('zii.widgets.jui.CJuiDialog');
        }
    }
}
