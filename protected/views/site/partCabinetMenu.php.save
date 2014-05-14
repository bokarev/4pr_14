       <?php 
             //TODO_WUD : ! [cabinet] role echo name    
             if($user->role==3) echo "<h1>Исполнитель</h1>" ;
             if($user->role==4 or $user->role=='') echo "<h1>Заказчик</h1>" ;
             if($user->role==1 and $user->superuser==0) echo "<h1>Модератор</h1>" ;
             if($user->role==1 and $user->superuser==1) echo "<h1>Администратор</h1>" ;
            
       ?>
       <?php 
        if($user->role==3) {           
           echo "баланс:";
        }
       ?>
      <ul class="side-nav">
        <?php 
        if($user->role==1) { ?>
            <li><a href="<?php echo $this->createUrl('/testComment/admin');?>">Новые видео и комментарии</a></li>            
        <?php } ?>
        <?php 
        if($user->role==3) { ?>
            <li><a href="<?php echo $this->createUrl('/users/profile/mytests');?>">Мои заявки на проекты</a></li> 
            <li><a href="<?php echo $this->createUrl('/users/profile/testertests');?>">Назначенные проекты</a></li>
            <!--<li><a href="<?php echo $this->createUrl('/users/profile/tests');?>">Мои тесты</a></li> --> 
             
        <?php } ?>
        <?php 
        if($user->role==4 or $user->role=='' or $user->superuser==1) { ?>
            <li><a href="<?php echo $this->createUrl('/users/profile/orders');?>">Мои заказы</a></li>   
            <li><a href="<?php echo $this->createUrl('/users/profile/testsclosed');?>">Завершенные заказы</a></li>             
        <?php } ?>
        <?php //echo $this->createUrl('/site/youtube');?>
        <!--<li><a href="<?php echo $this->createUrl('/message/view');?>">Мои сообщения</a></li>-->
        <li><a href="<?php echo $this->createUrl('/mailbox/message');?>">Мои сообщения</a></li>
        <li><a href="<?php echo $this->createUrl('/users/profile');?>">Персональная информация</a></li>
       
        <!--<li><a href="index.php?r=site/personal">Персональная информация</a></li>-->
      </ul>
