<?php
/**
 * Site start view
 */
//TODO_WUD : new index
?>

<div class="row">
    <div class="twelve columns" style="height:287px; background: url('images/share.gif') left center no-repeat;">

 
 
    <!-- Mobile Header 
 
 
    <div class="row">
      <div class="mobile-four show-for-small"><br>
        <img src="http://placehold.it/1000x600&text=For Small Screens" />
      </div>
    </div>
 
 
    End Mobile Header -->
 
    </div>
</div><br />
 
<!-- 

<div class="banners" align="center">
	<a href="/products/search/q/Apple"><img src="/themes/default/assets/images/mainPageBanner.png"></a>
</div>
-->
 
  
<div class="row">
    <div class="twelve columns">
        	
          </div> 
</div>
 
 
 
<div class="wide_line">
	<span>Сфера Ваших интересов</span>
</div> 

<div class="products_list">
     <ul class="services-block clearfix">
	<?php
        //TODO_PR : ! [index] first page vitrine
		foreach($types as $p)
			$this->renderPartial('_product', array('data'=>$p));
	?>
     </ul>
</div>

<?php $this->beginClip('underFooter'); ?>
<div class="centered">
	<div class="wide_line" style="margin-top: -61px">
		<span>Новые участники</span>
	</div>
	<div>
        <?php 
        $str ='"PHP, PERL, UML, Ajax, JavaScript, Mysql, PostgreSQL, MsSql, SOAP, XML, ActionScript2.0, Apache, Tomcat
Frameworks: Zend, CodeIgniter, Yii, Symfony, Modx, Drupal, Joomla, Mootools, Scriptacoulous, JQuery, ExtJs, Foundation
Системы контроля версий: git, mercurial, svn"';
        //TODO_PR : [dev list index page] view 
        foreach($devs as $val){ 
            if(isset($val['username'])){
                echo '<div class="view" style="overflow:hidden; height:170px; width:486px; float:right;margin:2px">';
                echo '<div style="margin:8px; float:left">';
                foreach($val['products'] as $values){                       
                    echo  '<a href="/product/' . $values[0] . '.html">'
                    . '<img alt="' . $values[1] . '" title="' . $values[1] 
                    . '"  src="/images/icons/services-sm-icon' . $values[2] . '.png" /></a>' ;                               
                }
                echo '</div><div style="float:right; margin:8px; width: 64px; color: #349fe3" >' ;
                if($val['userpic'] == '') $val['userpic'] = '11_-67685437.jpg';
                echo '<img alt="'  . $val['full_name'] . '" title="'  . $val['full_name'] . '" style=" " src="/uploads/userpic/thumb_' . $val['userpic'] . '" width="64px" /> <br />' 
                . $val['username'] . '</div>' . $val['known_computer'];               
                echo '</div>';  
            }
        }
        ?>

	</div>
</div>
<?php $this->endClip(); ?>

<!-- alpha --> 
  
  <div class="row">
    <div class="twelve columns">
      <div class="row">
 
        <div class="twelve columns" style="height: 259px; background:  url('images/icons/owl.gif') center bottom no-repeat;">
 
         
          <div class="six columns">
            <a href="javascript:void(0);" onClick='$("#mydialog").dialog("open"); return false;'>
                <div class="panel radius callout" align="center" style="height:30px; margin-top:154px; line-height:0;">
                    <strong>Я хочу сделать заказ</strong>
                </div>
            </a>
        
                <?php
         //TODO_PR : CJuiDialog index order form
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'mydialog',
            'options' => array(
                'title' => 'Отправить сообщение',
                'autoOpen' => false,
                'show'=>array(
                'effect'=>'blind',
                'duration'=>500,
                ),
                'hide'=>array(
                'effect'=>'explode',
                'duration'=>500,
                ),
                'modal' => true,
                'resizable' => false,
                
            ),
        ));
        $qForm = new QuickForm;
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'quick-form',
            'stateful' => true,
            'enableClientValidation' => true,
            
            'clientOptions' => array(
                //'validateOnChange' => true,
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array(
                'class' => 'form',
            ),
            'action' => array('/site/quick'), // когда форма показывается и в других контроллерах, не только 'site', то я в каждый из этих контроллеров вставил actionQuick, a здесь указал — array('quick'); почему-то не получается с array('//site/quick')
        ));
        ?>
        <?php echo $form->errorSummary($qForm); ?>
        <?php echo $form->hiddenField($qForm, 'url', array('value' => $_SERVER['PHP_SELF'])); ?>
        
        <?php echo $form->labelEx($qForm, 'name'); ?>
        <?php echo $form->textField($qForm, 'name', array('size' => 30)); ?>
        <?php echo $form->error($qForm, 'name'); ?>

        <?php echo $form->labelEx($qForm, 'email'); ?>
        <?php echo $form->textField($qForm, 'email', array('size' => 30)); ?>
        <?php echo $form->error($qForm, 'email'); ?>

        <?php echo $form->labelEx($qForm, 'phone'); ?>
        <?php echo $form->textField($qForm, 'phone', array('size' => 30)); ?>
        <?php echo $form->error($qForm, 'phone'); ?>

        <?php echo $form->labelEx($qForm, 'message'); ?>
        <?php 
        $qForm->message = '';
        
        echo $form->textArea($qForm, 'message', array('rows' => 40, 'cols' => 51, 'style'=>' height: 180px;')); ?>
        <?php echo $form->error($qForm, 'message'); ?>

        <?php echo CHtml::submitButton('Отправить'); ?>

        <?php
        $this->endWidget();
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        ?>

        <div style="clear:both;"><br /></div>
              
              
              
              
          </div>
          <div class="six columns">
            <a href="users/register">
                <div class="panel radius callout" align="center" style="height:30px; border-color: #a4b546; margin-top:154px; line-height:0; background: #afc14c">
                    <strong>Я хочу стать участником</strong>
                </div>
            </a>
          </div>         
        </div>
      </div>
    </div>
  </div>  
<!-- alpha -->