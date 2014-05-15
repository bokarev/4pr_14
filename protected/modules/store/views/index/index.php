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
        //TODO_WUD : ! [index] first page vitrine
		foreach($types as $p)
			$this->renderPartial('_product', array('data'=>$p));
	?>
     </ul>
</div>

<?php $this->beginClip('underFooter'); ?>
<div class="centered">
	<div class="wide_line">
		<span>Новости  из мира PR</span>
	</div>

	<ul class="news">
		<?php 
                //TODO_WUD : [base] index  
                foreach($news as $n): ?>
		<li>
			<!--<span class="date"><?php echo $n->created ?></span>-->
			<a href="<?php echo $n->viewUrl ?>" class="title"><?php echo $n->title ?></a>
			<p><?php echo $n->short_description ?></p>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php $this->endClip(); ?>

<!-- alpha --> 
  
  <div class="row">
    <div class="twelve columns">
      <div class="row">
 
        <div class="twelve columns" style="height: 259px; background:  url('images/icons/owl.gif') center bottom no-repeat;">
 
         
          <div class="six columns">
            <a href="users/register">
                <div class="panel radius callout" align="center" style="height:30px; margin-top:154px; line-height:0;">
                    <strong>Я хочу сделать заказ</strong>
                </div>
            </a>
          </div>
          <div class="six columns">
            <a href="users/register?tester">
                <div class="panel radius callout" align="center" style="height:30px; border-color: #a4b546; margin-top:154px; line-height:0; background: #afc14c">
                    <strong>Я хочу стать исполнителем</strong>
                </div>
            </a>
          </div>         
        </div>
      </div>
    </div>
  </div>  
<!-- alpha -->