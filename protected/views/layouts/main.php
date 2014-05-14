<?php

	Yii::import('application.modules.store.components.SCompareProducts');
	Yii::import('application.modules.store.models.wishlist.StoreWishlist');

	$assetsManager = Yii::app()->clientScript;
	$assetsManager->registerCoreScript('jquery');
	$assetsManager->registerCoreScript('jquery.ui');

	// jGrowl notifications
	Yii::import('ext.jgrowl.Jgrowl');
	Jgrowl::register();

	// Disable jquery-ui default theme
	$assetsManager->scriptMap=array(
		'jquery-ui.css'=>false,
	);
?>
<!DOCTYPE html>
<html>
<head>
        <title><?php echo CHtml::encode($this->pageTitle) ?></title>

        <!--alpha-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />        
        
        <!-- icons -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/images/social-webicons/stylesheets/app.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/images/social-webicons/stylesheets/fc-webicons.css">

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/images/social-webicons/javascripts/foundation/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<style type="text/css">
	 
	 .very-large { width: 200px; height: 200px; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px; }
	 
	</style>
    
        <!-- end alpha-->

	<meta name="description" content="<?php echo CHtml::encode($this->pageDescription) ?>">
	<meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords) ?>">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/reset.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/catalog.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/css/forms.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/jqueryui/css/custom-theme/jquery-ui-1.8.19.custom.css">

	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/common.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/js/menu.js"></script>
</head>
<body>

<?php
	// Notifier module form
//	Yii::import('application.modules.notifier.NotifierModule');
//	NotifierModule::renderDialog();
?>

<div id="header">
        <!-- alpha-->
                 <ul class="nav-bar" style="margin:0 0 15px 0">
                    <li><a href="<?php echo $this->createUrl('/page/about');?>">О проекте</a></li>
                    <li><a href="<?php echo $this->createUrl('/wiki/default/pageIndex');?>">Как это работает</a></li>
                    <!--<li><a href="#">Цены</a></li>
                    <li><a href="<?php echo $this->createUrl('/page/reviews');?>">Отзывы</a></li>-->
                    <li><a href="<?php echo $this->createUrl('/feedback/default/index');?>">Обратная связь</a></li>
                    <?php
                    if (Yii::app()->user->name == 'admin')
                          echo '<li class="active"><a href="/admin" target=_blank>Администрирование</a></li>';
                    ?>
        
                </ul> 
                <div id="login">
                    <div id="logo"><a href="http://4pr.ru"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"></a><?php //echo CHtml::encode(Yii::app()->name); ?></div>                  
                    <div class="reg" style="float:right">            
            <?php
            if(!Yii::app()->user->isGuest){  
             
                        echo '<a href="' . $this->createUrl('/users/profile') . '">
                                <div class="panel radius callout" style="height:30px; border-color: #a4b546; margin-top:14px; line-height:0; background: #afc14c url(\'/images/icons/key.gif\') left center no-repeat;" align="center">
                                <strong>&nbsp;&nbsp;&nbsp;&nbsp;Личный кабинет - ' . Yii::app()->user->name . '</strong>              
                                </div>
                              </a> ';    
            }else{ ?>
                        <a href="<?php echo $this->createUrl('/users/register'); ?>">
                            <div class="panel radius callout" style="height:30px; border-color: #a4b546; margin-top:14px; line-height:0; background: #afc14c url('/images/icons/key.gif') left center no-repeat;" align="center">
                                <strong>&nbsp;&nbsp;&nbsp;&nbsp;Зарегистрироваться</strong>
                            </div>
                        </a>
            <?php } ?>
                     </div>   
                     <div style="float:right; margin-right: 18px; margin-top: 28px;">
                            <?php
                            //TODO_WUD : свободен 
                            // занят
                            if(Yii::app()->user->isGuest){
                                echo  '<img src="/images/icons/enter.gif" style="color:black; float:left; margin-top: -2px;"  border=0/><a style="color:black;" href="' . $this->createUrl('/users/login') . '">&nbsp;Войти</a>';///users/login
                            }else{
                                echo  '<img src="/images/icons/enter.gif" style="color:black; float:left; margin-top: -2px;"  border=0/><a style="color:black;" href="' . $this->createUrl('/users/login/logout') . '">&nbsp;Выйти</a>';
                                
                            }?>                          
                     </div>
                     <div style="float:right; width: 325px; height: 62px; font-size: 16px;" id="cart">
				<?php $this->renderFile(Yii::getPathOfAlias('orders.views.cart._small_cart').'.php'); ?>
                     </div>
                    <!-- <div style="float:right; width: 325px; height: 62px; background: url('/images/icons/soc_share.gif')">
                        &nbsp;
                     </div> 
                    -->

                </div>
        <!-- end alpha-->
	<!-- Small top menu -->
	<div id="top_menu">
		<div class="left" style="margin-top:-25px">
                                    <div class="search_box">
				<?php echo CHtml::form($this->createUrl('/store/category/search')) ?>
					<input type="text" value="Поиск" name="q" id="searchQuery">
					<!--<button type="submit">Поиск</button>-->
				<?php echo CHtml::endForm() ?>
                                    </div> 
		</div>
		<div class="right">
			<ul style="font-size: 14px;">                                                     
                                
				<li>
					<a href="<?php echo Yii::app()->createUrl('/store/compare/index') ?>">
						<span class="icon compare"></span><?php echo Yii::t('core', '&nbsp;&nbsp;Проекты на сравнение ({c})', array('{c}'=>SCompareProducts::countSession())) ?>
					</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('/store/wishlist/index') ?>">
						<span class="icon heart"></span><?php echo Yii::t('core', '&nbsp;&nbsp;Список желаний ({c})', array('{c}'=>StoreWishlist::countByUser())) ?>
					</a>
				</li>
                                <li>
                                    <div class="currencies">
                                        <?php echo Yii::t('core','Валюта:') ?>
                                        <?php
					foreach(Yii::app()->currency->currencies as $currency)
					{
						echo CHtml::ajaxLink($currency->symbol, '/store/ajax/activateCurrency/'.$currency->id, array(
							'success'=>'js:function(){window.location.reload(true)}',
						),array('id'=>'sw'.$currency->id,'class'=>Yii::app()->currency->active->id===$currency->id?'active':''));
					}
                                        ?>
                                    </div>
                                </li>
                                <?php if(!Yii::app()->user->isGuest): ?>
	
					<?php echo "<li>" . CHtml::link(Yii::t('core','Мои заказы'), array('/users/profile/orders'), array('class'=>'light')) . "</li>" ?>
					

				<?php endif; ?>
			</ul>
		</div>

	</div>
	<!--<div class="mainm">
		<?php //TODO_WUD : [main] навигация на первой странице
			Yii::import('application.modules.store.models.StoreCategory');
			$items = StoreCategory::model()->findByPk(1)->asCMenuArray();
			if(isset($items['items']))
			{
				$this->widget('application.extensions.mbmenu.MbMenu',array(
					'cssFile'=>Yii::app()->theme->baseUrl.'/assets/css/menu.css',
					'htmlOptions'=>array('class'=>'dropdown', 'id'=>'nav'),
					'items'=>$items['items'])
				);
			}
		?>
	</div>
        -->
</div>
    


<div id="content">
	<?php if(($messages = Yii::app()->user->getFlash('messages'))): ?>
		<div class="flash_messages">
			<button class="close">×</button>
			<?php
				if(is_array($messages))
					echo implode('<br>', $messages);
				else
					echo $messages;
			?>
		</div>
	<?php endif; ?>

	<?php echo $content; ?>
</div><!-- content end -->

<div style="clear:both;"></div>
<?php 
//TODO_WUD : [base] I wanna order test
if (isset($this->clips['underFooter'])) echo $this->clips['underFooter']; ?>
    



<div id="footer">
            <!-- Footer -->

            <footer class="row" style="background: #5f656f; height:92px">
                <div class="twelve columns">
                    <div class="row">

                        <div class="four columns">
                            <a href="http://4pr.ru"><img src="/images/logo_white.png" style="border:0;"/></a>
                            <p style="color:#82868c">&copy; 4pr.ru 2013</p>
                        </div>
                        <div class="five columns">
                            <div style="margin-top:40px;">
                                <!--<a href="<?php echo $this->createUrl('/page/about');?>" style="color:white; font-weight: bold; font-size: 16px; text-transform: uppercase; margin:10px;">о проекте</a>
                                <a href="<?php echo $this->createUrl('/testList/index');?>" style="color:white; font-weight: bold; font-size: 16px; text-transform: uppercase; margin:10px;">тесты</a>
                                <a href="#" style="color:white; font-weight: bold; font-size: 16px; text-transform: uppercase; margin:10px;">цены</a>
                                <a href="<?php echo $this->createUrl('/page/reviews');?>" style="color:white; font-weight: bold; font-size: 16px; text-transform: uppercase; margin:10px;">отзывы</a>-->
                            </div>
                        </div>
                        <div class="three columns">
                            <ul class="link-list" style="float:right; margin-top: 30px;"> 
                                <li style="margin: 2px; "><a href="http://www.facebook.com/4pr.ru" target=_blank class="fc-webicon facebook">Мы на Facebook</a></li>
                                <li style="margin: 2px; "><a href="http://linkedin.com" target=_blank class="fc-webicon linkedin">Мы на LinkedIn</a></li>
                                <li style="margin: 2px; "><a href="http://twitter.com/4prRu" target=_blank class="fc-webicon twitter">Мы на Twitter</a></li>
                                <li style="margin: 2px; "><a href="http://www.youtube.com" target=_blank class="fc-webicon youtube">Мы на YouTube</a></li>
                                <li style="margin: 2px; "><a href="http://google.com" target=_blank class="fc-webicon googleplus">Мы на Google+</a></li>
                                <li style="margin: 2px; "><a href="feedback" target=_blank class="fc-webicon mail">Cвязь</a></li>
                            </ul>
                            <!--<ul class="link-list right" style="margin-top:32px;">
                                    <li style="margin: 2px; margin-top: 4px;"><a href="http://skype.com" target=_blank class="fc-webicon skype">Skype</a></li>
                                    <li style="margin: 2px; margin-top: 4px;"><a href="#" target=_blank class="fc-webicon rss">RSS</a></li>          
                            </ul>-->
                        </div>

                    </div>
                </div>
            </footer>

            <!-- End Footer -->
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44089381-1', '4pr.ru');
  ga('send', 'pageview');

</script>
</body>
</html>