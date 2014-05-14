<?php
/* @var $this SiteController */
?>
<h3>Работа с проектами</h3>
<?php $err = "Ошибка"; 
//Понять причину появления - в локальной версии этого нет
//TODO_WUD : err
//Undefined variable: err 
//http://23.20.180.2/wud/index.php?r=site/projects#profile
?>
  <!-- Main Page Content and Sidebar -->
 
  <div class="row">
 
    <!-- Main Blog Content -->
    <div class="nine columns" role="content">
 
      <article>           
            <dl class="tabs">
            <dd <?php echo ($err)?'':'class="active"' ?> ><a href="#projects">Проекты</a></dd>
            <dd <?php echo ($err)?'class="active"':'' ?> ><a href="#create">Создать проект</a></dd>
            </dl>
            <ul class="tabs-content">
            <li <?php echo ($err)?'':'class="active"' ?> id="projectsTab">    
              
<?php   $dataProvider->pagination->pageSize = 1000;
        // TODO_WUD : projects zii.widgets.CListView

        $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewProjects',
        'emptyText'=>' У Вас нет проектов',                     
        'enablePagination'=>false,
        'template'=>'{summary}{items}',//{items}<hr />{pager}
        'summaryText'=>"Проектов: {count}",

        )); 
        ?>
            </li>  
            <li id="createTab">
                <?php echo $this->renderPartial('_formProjects', array('model'=>$model)); ?>
            </li>
            </ul><p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
 
      </article>

 
    </div>
 
    <!-- End Main Content -->
 
 
    <!-- Sidebar -->
 
    <aside class="three columns">
        
       <?php    // TODO_WUD : part cab
		$this->renderPartial('partCabinetMenu');
        ?>
 
      <div class="panel">
        <h5>Wiki помощь</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>
 
    </aside>
 
    <!-- End Sidebar -->
  </div>
 
  <!-- End Main Content and Sidebar -->
